<x-layout>
  <x-slot:heading>Log in</x-slot:heading>

  <form method="POST" action="/login">
    @csrf

    <div class="space-y-5">
      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
          <x-form-field>
            <x-form-label for="email">Email</x-form-label>
            
            <div class="mt-2">
              <x-form-input type="email" name="email" id="email" placeholder="examle@gmail.com" :value="old('email')" required/>

              <x-form-error name="email" />
            </div>
          </x-form-field>
          
          <x-form-field>
            <x-form-label for="password">Password</x-form-label>
            
            <div class="mt-2">
              <x-form-input type="password" name="password" id="password" required/>

              <x-form-error name="password" />
            </div>
          </x-form-field>
        </div>
      </div>
    </div>

      <x-form-button>Login</x-form-button>
  </form>

</x-layout>