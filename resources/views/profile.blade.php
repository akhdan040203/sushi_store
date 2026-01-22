<x-store-layout title="Profile Settings - Sushi Store">
    <div class="profile-page-wrapper">
        <div class="profile-container">
            <header class="profile-header-section">
                <h1>User Settings</h1>
                <p>Manage your account settings and security</p>
            </header>

            <div class="profile-content">
                <!-- Update Profile Info -->
                <div class="profile-card">
                    <livewire:profile.update-profile-information-form />
                </div>

                <!-- Update Password -->
                <div class="profile-card">
                    <livewire:profile.update-password-form />
                </div>

                <!-- Delete Account -->
                <div class="profile-card delete-btn-wrapper">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-store-layout>
