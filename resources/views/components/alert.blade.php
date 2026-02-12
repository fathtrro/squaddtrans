<div class="fixed inset-0 z-50 flex items-center justify-center" id="alertOverlay" style="display: none;">
    <!-- Blur glass background overlay with enhanced blur effect -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-xl" onclick="if(event.target === event.currentTarget) closeAlert()" style="animation: fadeIn 0.3s ease-out;"></div>

    <!-- Alert card with Material Design inspired layout -->
    <div class="relative bg-white rounded-2xl w-full mx-4 overflow-hidden max-w-lg animate-bounce-in" style="
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.16),
                    0 4px 12px rgba(0, 0, 0, 0.12);
        animation: slideUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    ">

        <!-- Colored header bar -->
        <div id="alertHeaderBar" class="h-1 w-full bg-gradient-to-r from-blue-500 to-blue-600"></div>

        <!-- Header section with colored background -->
        <div id="alertHeaderSection" class="bg-gradient-to-r from-blue-50 to-blue-50/80 px-6 py-6">
            <div class="flex gap-4">
                <!-- Icon circle -->
                <div id="alertIconBox" class="flex-shrink-0 flex items-center justify-center w-14 h-14 rounded-full border-2 border-blue-300 bg-white">
                    <div id="alertIcon" class="flex items-center justify-center">
                        <!-- Icon will be inserted here -->
                    </div>
                </div>

                <!-- Title and message -->
                <div class="flex-1 pr-2">
                    <h3 id="alertTitle" class="text-lg font-bold text-blue-900 mb-1">
                        <!-- Title will be inserted -->
                    </h3>
                    <p id="alertMessage" class="text-sm text-gray-700 leading-relaxed">
                        <!-- Message will be inserted -->
                    </p>
                </div>

                <!-- Close button -->
                <button onclick="closeAlert()" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Details section (optional) -->
        <div id="alertDetails" class="bg-white px-6 py-4 border-t border-gray-100 hidden">
            <p id="alertDetailsContent" class="text-sm text-gray-700 leading-relaxed"></p>
        </div>

        <!-- Buttons section -->
        <div id="alertButtons" class="bg-gray-50 px-6 py-5 flex gap-3 justify-end">
            <!-- Buttons will be inserted here -->
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce-in {
        0% {
            opacity: 0;
            transform: scale(0.85) translateY(-20px);
        }
        50% {
            opacity: 1;
            transform: scale(1.02);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-bounce-in {
        animation: slideUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
</style>

<script>
    function showAlert(config) {
        const {
            type = 'info',
            title = 'Alert',
            message = '',
            details = null,
            buttons = null,
            onClose = null
        } = config;

        const overlay = document.getElementById('alertOverlay');
        const headerBar = document.getElementById('alertHeaderBar');
        const headerSection = document.getElementById('alertHeaderSection');
        const iconBox = document.getElementById('alertIconBox');
        const iconEl = document.getElementById('alertIcon');
        const titleEl = document.getElementById('alertTitle');
        const messageEl = document.getElementById('alertMessage');
        const detailsEl = document.getElementById('alertDetails');
        const detailsContentEl = document.getElementById('alertDetailsContent');
        const buttonsEl = document.getElementById('alertButtons');

        // Material Design color configurations
        const typeConfig = {
            success: {
                icon: '<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>',
                headerBg: 'from-green-50 to-green-50/80',
                headerBar: 'from-green-500 to-green-600',
                titleColor: 'text-green-900',
                iconBorder: 'border-green-300',
                buttonPrimary: 'bg-green-600 hover:bg-green-700 text-white'
            },
            error: {
                icon: '<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4v2m0 5a9 9 0 110-18 9 9 0 010 18zm0-13a1 1 0 00-1 1v3a1 1 0 002 0v-3a1 1 0 00-1-1z"></path></svg>',
                headerBg: 'from-red-50 to-red-50/80',
                headerBar: 'from-red-500 to-red-600',
                titleColor: 'text-red-900',
                iconBorder: 'border-red-300',
                buttonPrimary: 'bg-red-600 hover:bg-red-700 text-white'
            },
            warning: {
                icon: '<svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                headerBg: 'from-yellow-50 to-yellow-50/80',
                headerBar: 'from-yellow-500 to-yellow-600',
                titleColor: 'text-yellow-900',
                iconBorder: 'border-yellow-300',
                buttonPrimary: 'bg-yellow-600 hover:bg-yellow-700 text-white'
            },
            info: {
                icon: '<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                headerBg: 'from-blue-50 to-blue-50/80',
                headerBar: 'from-blue-500 to-blue-600',
                titleColor: 'text-blue-900',
                iconBorder: 'border-blue-300',
                buttonPrimary: 'bg-blue-600 hover:bg-blue-700 text-white'
            }
        };

        const config_type = typeConfig[type] || typeConfig.info;

        // Update header bar
        headerBar.className = `h-1 w-full bg-gradient-to-r ${config_type.headerBar}`;

        // Update header section
        headerSection.className = `bg-gradient-to-r ${config_type.headerBg} px-6 py-6`;

        // Update icon box
        iconBox.className = `flex-shrink-0 flex items-center justify-center w-14 h-14 rounded-full border-2 ${config_type.iconBorder} bg-white`;

        // Update icon
        iconEl.innerHTML = config_type.icon;

        // Update title with color
        titleEl.textContent = title;
        titleEl.className = `text-lg font-bold ${config_type.titleColor} mb-1`;

        // Update message
        messageEl.textContent = message;

        // Handle details
        if (details) {
            detailsEl.classList.remove('hidden');
            detailsContentEl.innerHTML = details;
        } else {
            detailsEl.classList.add('hidden');
        }

        // Create buttons
        if (buttons) {
            buttonsEl.innerHTML = buttons;
        } else {
            buttonsEl.innerHTML = `
                <button onclick="closeAlert()" class="px-8 py-3.5 ${config_type.buttonPrimary} rounded-lg font-bold text-base transition-colors shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95">
                    OK
                </button>
            `;
        }

        // Store callback
        window._alertOnClose = onClose;

        // Show overlay
        overlay.style.display = 'flex';
    }

    function closeAlert() {
        const overlay = document.getElementById('alertOverlay');
        overlay.style.display = 'none';

        if (window._alertOnClose) {
            window._alertOnClose();
            window._alertOnClose = null;
        }
    }

    // Close on escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAlert();
    });
</script>
