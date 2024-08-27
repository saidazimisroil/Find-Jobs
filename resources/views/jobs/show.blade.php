<x-layout>
  <x-slot:heading>Job Page</x-slot:heading>
  
  <strong>{{ $job->title }}</strong>
  <p>{{ $job->salary }}</p>

  @can('edit', $job)
    <div class="mt-6">
      <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
    </div>
  @endcan
</x-layout>