<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Report Details Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold">Report Details</h1>
                        <p class="text-blue-100 text-sm mt-1">Report ID: <span class="font-mono font-semibold">{{ $report->id }}</span></p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        <span class="px-4 py-2 rounded-full text-xs font-semibold
                            @if($report->statement == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($report->statement == 'on_process') bg-blue-100 text-blue-800
                            @elseif($report->statement == 'done') bg-green-100 text-green-800
                            @elseif($report->statement == 'rejected') bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($report->statement) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Image Column -->
                    <div class="lg:col-span-1">
                        @if($report->image)
                            <div class="relative rounded-xl overflow-hidden shadow-md aspect-video bg-gray-100">
                                <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" 
                                     class="w-full h-full object-cover transition-opacity duration-300 hover:opacity-90">
                            </div>
                        @else
                            <div class="rounded-xl bg-gray-100 aspect-video flex items-center justify-center text-gray-400">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif
                        
                        <div class="mt-6 flex items-center space-x-6">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-thumbs-up text-blue-500 mr-2"></i>
                                <span class="font-medium">{{ $report->voting }} Votes</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-eye text-gray-500 mr-2"></i>
                                <span class="font-medium">{{ $report->viewers }} Views</span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Column -->
                    <div class="lg:col-span-2">
                        <div class="space-y-5">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Description</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Type</h3>
                                    <p class="text-gray-700">{{ $report->type }}</p>
                                </div>
                                
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Location</h3>
                                    <div class="space-y-1">
                                        <p class="text-gray-700">{{ $report->village }}, {{ $report->subdistrict }}</p>
                                        <p class="text-gray-700">{{ $report->regency }}, {{ $report->province }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Update Section (for staff) -->
            @if(auth()->user()->role === 'STAFF')
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-5">
                <div class="max-w-md">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Update Report Status</h3>
                    <form action="{{ route('report.updateStatus', $report->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <select name="statement" id="statement" 
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    @if($report->statement === 'done') disabled @endif>
                                <option value="on_process" {{ $report->statement == 'on_process' ? 'selected' : '' }}>On Process</option>
                                <option value="done" {{ $report->statement == 'done' ? 'selected' : '' }}>Done</option>
                                <option value="rejected" {{ $report->statement == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        @if($report->statement !== 'done')
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Status
                            </button>
                        @else
                            <button type="button" 
                                    class="px-6 py-2 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed" 
                                    disabled>
                                Report Already Resolved
                            </button>
                        @endif
                    </form>
                </div>
            </div>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="mt-10">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Comments</h2>
                </div>
                
                <!-- Comment Form -->
                <div class="p-6 border-b border-gray-200">
                    <form action="{{ route('admin.report.comment', $report->id) }}" method="POST">
                        @csrf
                        <textarea name="comment" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                rows="3" 
                                placeholder="Share your thoughts about this report..." 
                                required></textarea>
                        <div class="mt-3">
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Comments List -->
                <div class="divide-y divide-gray-200">
                    @forelse($report->comments as $comment)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="text-gray-700 mt-1 leading-relaxed">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            <p>No comments yet. Be the first to comment!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>