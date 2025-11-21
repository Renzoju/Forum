@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="bg-[#1a1c22] border border-gray-800 shadow-md sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-100 mb-4">Profiel gegevens</h2>
                <div class="max-w-xl text-gray-300">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>


            <div class="bg-[#1a1c22] border border-gray-800 shadow-md sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-100 mb-4">Wachtwoord wijzigen</h2>
                <div class="max-w-xl text-gray-300">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


            <div class="bg-[#1a1c22] border border-gray-800 shadow-md sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-100 mb-4">Account verwijderen</h2>
                <div class="max-w-xl text-gray-300">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
@endsection
