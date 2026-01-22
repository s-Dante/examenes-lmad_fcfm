@props(['message'])

<div class="max-w-4xl mx-auto my-8 px-4">
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r shadow-sm flex items-center">
        <div class="flex-shrink-0 mr-4 text-2xl">
            💡 </div>
        <div>
            <p class="text-blue-900 font-medium text-lg">{{ $message }}</p>
        </div>
    </div>
</div>