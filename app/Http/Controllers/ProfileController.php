<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Show user profile page
     */
    public function show()
    {
        $user = Auth::user();

        // Get user addresses
        $addresses = UserAddress::where('user_id', $user->id)->get();

        // Get user orders with items
        $orders = Order::with('items')
            ->where('user_id', $user->id)
            ->orderBy('order_date', 'desc')
            ->paginate(5);

        return view('profile.index', compact('user', 'addresses', 'orders'));
    }

    /**
     * Show edit profile form
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female',
            'birth_date' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                $oldPhotoPath = 'public/profiles/' . $user->profile_photo;
                if (Storage::exists($oldPhotoPath)) {
                    Storage::delete($oldPhotoPath);
                }
            }

            // Generate unique filename
            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = 'profile_' . $user->id . '_' . time() . '_' . Str::random(10) . '.' . $extension;

            // Store the file
            $file->storeAs('public/profiles', $filename);

            // Save filename to database
            $validated['profile_photo'] = $filename;

            // Log for debugging
            \Log::info('Profile photo uploaded', [
                'user_id' => $user->id,
                'filename' => $filename,
                'path' => 'storage/profiles/' . $filename
            ]);
        }

        // Update user data
        $user->update($validated);

        // Clear any cache if you're using it
        // Cache::forget('user_' . $user->id);

        return redirect()->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui!')
            ->with('photo_updated', true); // Flag untuk refresh foto
    }

    /**
     * Show create address form
     */
    public function createAddress()
    {
        return view('profile.address-form');
    }

    /**
     * Store new address
     */
    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'address_type' => 'required|in:Home,Office',
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'required|string|max:100',
            'is_primary' => 'boolean'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['is_primary'] = $request->has('is_primary') ? true : false;

        // If this is set as primary, unset other primary addresses
        if ($validated['is_primary']) {
            UserAddress::where('user_id', Auth::id())
                ->update(['is_primary' => false]);
        }

        UserAddress::create($validated);

        return redirect()->route('profile.index')->with('success', 'Alamat berhasil ditambahkan!');
    }

    /**
     * Show edit address form
     */
    public function editAddress($id)
    {
        $address = UserAddress::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('profile.address-form', compact('address'));
    }

    /**
     * Update address
     */
    public function updateAddress(Request $request, $id)
    {
        $address = UserAddress::where('user_id', Auth::id())
            ->findOrFail($id);

        $validated = $request->validate([
            'address_type' => 'required|in:Home,Office',
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'required|string|max:100',
            'is_primary' => 'boolean'
        ]);

        $validated['is_primary'] = $request->has('is_primary') ? true : false;

        // If this is set as primary, unset other primary addresses
        if ($validated['is_primary']) {
            UserAddress::where('user_id', Auth::id())
                ->where('id', '!=', $id)
                ->update(['is_primary' => false]);
        }

        $address->update($validated);

        return redirect()->route('profile.index')->with('success', 'Alamat berhasil diperbarui!');
    }

    /**
     * Delete address
     */
    public function deleteAddress($id)
    {
        $address = UserAddress::where('user_id', Auth::id())
            ->findOrFail($id);

        $address->delete();

        return redirect()->route('profile.index')->with('success', 'Alamat berhasil dihapus!');
    }

    /**
     * Get orders with pagination
     */
    public function getOrders(Request $request)
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->orderBy('order_date', 'desc')
            ->paginate($request->get('per_page', 5));

        return response()->json($orders);
    }
}
