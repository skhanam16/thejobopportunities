<x-layout>
<h2 class="text-3xl text-center mb-4 font-bold border border-gray-300 p-3">
    Bookmarked Jobs
</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      
          @forelse($bookmarks as $bookmark)
         <x-job-card :job="$bookmark"/>
       {{-- <a href="{{route('jobs.show', $job->id)}}">{{$job->title}} -{{$job->description}}</a> --}}
        @empty
        <p class="text-gray-500 text-center">You have no bookmarks</p>
        @endforelse
    </div>
        <!-- Pagination links -->
    {{ $bookmarks->links() }}
</x-layout>
