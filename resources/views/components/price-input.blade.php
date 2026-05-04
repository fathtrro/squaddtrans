{{-- 
    Price Input Component - Format harga dengan separator dan validasi
    
    Props:
    - value: Initial price value
    - name: Input name attribute
    - label: Label text
    - placeholder: Placeholder text
    - required: Is required field
    - min: Minimum value
    - step: Step value (default: 1000)
    - helpText: Help text below input
    - textRight: Menampilkan format harga di kanan
--}}

<div class="price-input-wrapper {{ $class ?? '' }}">
    @if($label ?? false)
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        {{ $label }}
        @if($required ?? false)
            <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    
    <div class="relative">
        <div class="absolute left-0 top-0 bottom-0 flex items-center pl-4 pointer-events-none">
            <span class="text-gray-500 font-semibold">Rp</span>
        </div>
        
        <input 
            type="text"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $formattedValue ?? '' }}"
            placeholder="{{ $placeholder ?? 'Masukkan harga' }}"
            {{ $required ?? false ? 'required' : '' }}
            class="w-full pl-12 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-colors text-gray-900 font-semibold price-input-field @error($name) border-red-500 @enderror"
            inputmode="numeric"
            data-price-input
        >
        
        @if($textRight ?? false)
        <div class="absolute right-0 top-0 bottom-0 flex items-center pr-4 pointer-events-none">
            <span class="text-xs text-gray-400 price-preview">-</span>
        </div>
        @endif
    </div>
    
    @if($helpText ?? false)
    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
        </svg>
        {{ $helpText }}
    </p>
    @endif
    
    @error($name)
    <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        {{ $message }}
    </p>
    @enderror
    
    <!-- Hidden input untuk menyimpan nilai numerik -->
    <input type="hidden" name="{{ $name }}_numeric" id="{{ $name }}_numeric">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputField = document.getElementById('{{ $name }}');
    const hiddenInput = document.getElementById('{{ $name }}_numeric');
    const pricePreview = inputField.parentElement.querySelector('.price-preview');
    
    if (!inputField) return;
    
    // Format input value on load
    formatPriceInput(inputField, hiddenInput, pricePreview);
    
    // Format on input
    inputField.addEventListener('input', function(e) {
        formatPriceInput(this, hiddenInput, pricePreview);
    });
    
    // Format on blur (cleanup)
    inputField.addEventListener('blur', function(e) {
        formatPriceInput(this, hiddenInput, pricePreview);
    });
    
    // Prevent non-numeric characters
    inputField.addEventListener('keypress', function(e) {
        if (!/[0-9]/.test(e.key)) {
            e.preventDefault();
        }
    });
});

function formatPriceInput(displayInput, hiddenInput, preview) {
    // Remove all non-numeric characters
    let value = displayInput.value.replace(/[^\d]/g, '');
    
    // Update hidden input with raw value
    if (hiddenInput) {
        hiddenInput.value = value;
    }
    
    // Format display value with thousand separators
    if (value) {
        const formatted = parseInt(value).toLocaleString('id-ID');
        displayInput.value = formatted;
        
        // Update preview if exists
        if (preview) {
            preview.textContent = formatted;
        }
    } else {
        displayInput.value = '';
        if (preview) {
            preview.textContent = '-';
        }
    }
}
</script>

<style>
.price-input-wrapper input[type="text"] {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    letter-spacing: 0.5px;
}

.price-input-wrapper input:focus {
    box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.1);
}
</style>
