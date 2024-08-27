<x-layout>
  <x-slot:heading>Form for Crating a New Job</x-slot:heading>

  <form method="POST" action="/jobs">
    @csrf

    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Create a new job</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Enter information about your job.</p>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <x-form-field>
            <x-form-label for="title">Title</x-form-label>
            
            <div class="mt-2">
              <x-form-input type="text" name="title" id="title" placeholder="CEO" required/>

              <x-form-error name="title" />
            </div>
          </x-form-field>
          
          <x-form-field>
            <x-form-label for="salary">Salary</x-form-label>
            
            <div class="mt-2">
              <x-form-input type="text" name="salary" id="salary" placeholder="$50.000 Per Year" required/>

              <x-form-error name="salary" />
            </div>
          </x-form-field>

        </div>
      </div>
    </div>

      <x-form-button type="submit">Create</x-form-button>
  </form>

</x-layout>