{{-- resources/views/admin/components/input.blade.php --}}
<div class="space-y-2">
    @if($label)
    <label class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if($required)<span class="text-red-500">*</span>@endif
    </label>
    @endif
    <input {{ $attributes->merge(['class' => 'w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500']) }}>
    @error($name)
    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>