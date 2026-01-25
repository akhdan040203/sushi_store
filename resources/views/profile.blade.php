<x-settings-layout title="Profile Settings">
    <div class="settings-title">
        <h1>User Settings</h1>
        <p>Manage your account settings and security</p>
    </div>

    <!-- Update Profile Info -->
    <div class="settings-card">
        <livewire:profile.update-profile-information-form />
    </div>

    <!-- Update Password -->
    <div class="settings-card">
        <livewire:profile.update-password-form />
    </div>

    <!-- Delete Account -->
    <div class="settings-card delete-section">
        <livewire:profile.delete-user-form />
    </div>
</x-settings-layout>
