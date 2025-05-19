<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom styles -->
    <style>
        :root {
    /* Warm coral/orange palette */
    --primary-color: #FF7043;           /* Warm coral/orange */
    --primary-dark: #D84315;            /* Deep coral */
    --primary-light: #FFA270;           /* Light coral */
    --accent-amber: #FFC107;            /* Amber */
    --accent-green: #66BB6A;            /* Green for success */
    --accent-red: #EF5350;              /* Red for danger */
    --sidebar-bg: linear-gradient(135deg, #FF7043 0%, #FFA270 100%); /* Coral to light coral */
    --sidebar-active: #FFC107;          /* Amber accent */
    --sidebar-hover: #FFD8B5;           /* Light amber/coral */
    --topbar-bg: linear-gradient(90deg, #FFF3E0 0%, #FFE0B2 100%);  /* Soft gradient */
    --topbar-border: #F5F5F5;
    --welcome-gradient: linear-gradient(90deg, #FF7043 0%, #FFD8B5 100%); /* Coral to light coral/amber */
    --body-bg: #FAFAFA;                 /* Soft gray */
    --card-bg: #FFFFFF;
    --element-bg: #F5F5F5;
    --element-border: #ECECEC;
    --text-primary: #333333;            /* Soft dark gray */
    --text-secondary: #757575;          /* Medium gray */
    --success-color: #66BB6A;           /* Green */
    --warning-color: #FFC107;           /* Amber */
    --danger-color: #EF5350;            /* Red */
}
        
        body {
            background-color: var(--body-bg);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
        }
        
        /* Improved typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            font-weight: 600;
            letter-spacing: -0.025em;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 8px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        .content-wrapper {
    margin-left: 80px !important; /* Match sidebar width, force alignment */
    padding-left: 0 !important;
    border-left: 1px solid var(--element-border);
    background: transparent;
    box-shadow: -5px 0 30px 0 rgba(0, 0, 0, 0.02);
    min-height: 100vh;
    transition: all 0.3s ease;
}
        
        /* Modern gradient cards */
        .gradient-card-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            position: relative;
            overflow: hidden;
            color: white;
            border-radius: 16px;
        }
        
        .gradient-card-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,.075)' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        .gradient-card-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #1a9b6c 100%);
            color: white;
            border-radius: 16px;
        }
        
        .gradient-card-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #f48c06 100%);
            color: white;
            border-radius: 16px;
        }
        
        .gradient-card-danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #d90429 100%);
            color: white;
            border-radius: 16px;
        }
        
        .gradient-card-info {
            background: linear-gradient(135deg, var(--info-color) 0%, #3a86ff 100%);
            color: white;
            border-radius: 16px;
        }
        
        /* Enhanced shadows */
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(67, 97, 238, 0.1), 0 8px 10px -6px rgba(67, 97, 238, 0.05);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(67, 97, 238, 0.15), 0 10px 10px -5px rgba(67, 97, 238, 0.1);
            transform: translateY(-5px);
        }
        
        /* Enhanced glass effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(67, 97, 238, 0.08);
            border-radius: 16px;
        }
        
        /* Animation effects */
        .hover-lift {
            transition: transform 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
        }
        
        /* Custom button styles */
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(67, 97, 238, 0.1), 0 2px 4px -1px rgba(67, 97, 238, 0.06);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 10px 15px -3px rgba(67, 97, 238, 0.1), 0 4px 6px -2px rgba(67, 97, 238, 0.05);
            transform: translateY(-2px);
        }
        
        /* Pulse animation for notifications */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 107, 107, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 107, 107, 0);
            }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        /* Fade in animation for cards */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        /* Staggered animation delays for multiple items */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        
        /* Modern badge styles */
        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50rem;
        }
        
        /* Progress bar styles */
        .progress-thin {
            height: 4px;
            border-radius: 2px;
            overflow: hidden;
        }
    </style>
    
    @yield('styles')
</head>

<body>
<div style="background: #ff7043; color: #fff; text-align: center; font-size: 18px; font-weight: bold; padding: 10px; z-index:99999; position:relative;">admin_new.blade.php LAYOUT IS ACTIVE</div>
<!-- THEME MODAL MOVED OUTSIDE MAIN WRAPPER -->
<style>
  @keyframes fadeInModal {
    0% { opacity: 0; }
    100% { opacity: 1; }
  }
  #theme-modal {
    animation: fadeInModal 0.22s cubic-bezier(.4,0,.2,1);
  }
  @media (max-width: 600px) {
    #theme-modal-box { max-width: 95vw !important; padding: 1.25rem !important; }
  }
</style>
<div id="theme-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
    <button id="close-theme-modal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
    <h2 class="text-lg font-bold mb-4">Theme Selector</h2>
    <div class="space-y-4">
      <div>
        <label class="block font-medium mb-1">Background</label>
        <input type="color" id="theme-bg" value="#FAFAFA" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Sidebar</label>
        <input type="color" id="theme-sidebar" value="#FF7043" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Topbar</label>
        <input type="color" id="theme-topbar" value="#FFF3E0" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Welcome Banner</label>
        <input type="color" id="theme-welcome" value="#FF7043" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Elements</label>
        <input type="color" id="theme-element" value="#F5F5F5" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
    </div>
    <button id="save-theme" class="mt-6 w-full bg-primary-color text-white py-2 rounded-lg font-semibold hover:bg-primary-dark transition">Apply Theme</button>
  </div>
</div>
<!-- END THEME MODAL -->
    <div class="min-h-screen">
    @include('admin.layouts.sidebar')
    
    <!-- Main Content -->
    <div class="content-wrapper min-h-screen p-0">
        @include('admin.layouts._topbar')
        
        <!-- Page Content -->
        <main class="p-6">
            <!-- Page content -->
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer class="bg-orange-50 py-4 px-6 border-t border-orange-100 mt-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between text-sm text-gray-500">
                <div>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</div>
                <div class="mt-2 md:mt-0">Version 1.0.0</div>
            </div>
        </footer>
    </div>
    
    <!-- Scripts -->
    <script>
        // User dropdown toggle
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.querySelector('button:has(+ .w-48)');
            const profileDropdown = document.querySelector('.w-48');
            
            if (profileButton && profileDropdown) {
                profileButton.addEventListener('click', function() {
                    profileDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                        profileDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    
    <!-- Theme Selector Modal -->
<div id="theme-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
    <button id="close-theme-modal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
    <h2 class="text-lg font-bold mb-4">Theme Selector</h2>
    <div class="space-y-4">
      <div>
        <label class="block font-medium mb-1">Background</label>
        <input type="color" id="theme-bg" value="#FAFAFA" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Sidebar</label>
        <input type="color" id="theme-sidebar" value="#FF7043" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Topbar</label>
        <input type="color" id="theme-topbar" value="#FFF3E0" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Welcome Banner</label>
        <input type="color" id="theme-welcome" value="#FF7043" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
      <div>
        <label class="block font-medium mb-1">Elements</label>
        <input type="color" id="theme-element" value="#F5F5F5" class="w-10 h-10 border-0 bg-transparent cursor-pointer">
      </div>
    </div>
    <button id="save-theme" class="mt-6 w-full bg-primary-color text-white py-2 rounded-lg font-semibold hover:bg-primary-dark transition">Apply Theme</button>
  </div>
</div>


{{-- @push('scripts')
<script>
// Helper: Get and set CSS variables
function setThemeVars(vars) {
  for (const [key, value] of Object.entries(vars)) {
    document.documentElement.style.setProperty(`--${key}`, value);
  }
}
function getThemeVars() {
  return {
    'body-bg': document.getElementById('theme-bg').value,
    'sidebar-bg': document.getElementById('theme-sidebar').value,
    'topbar-bg': document.getElementById('theme-topbar').value,
    'welcome-gradient': document.getElementById('theme-welcome').value,
    'element-bg': document.getElementById('theme-element').value
  };
}
// Modal controls
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('theme-modal');
  const closeBtn = document.getElementById('close-theme-modal');
  Array.from(document.querySelectorAll('.open-theme-modal')).forEach(btn => {
    btn.onclick = () => modal.classList.remove('hidden');
  });
  closeBtn.onclick = () => modal.classList.add('hidden');
  window.onclick = (e) => { if (e.target === modal) modal.classList.add('hidden'); };
});
// Save/apply theme
const saveBtn = document.getElementById('save-theme');
saveBtn.onclick = function() {
  const vars = getThemeVars();
  // For gradients, set solid color for demo; can be improved for gradients
  setThemeVars({
    'body-bg': vars['body-bg'],
    'sidebar-bg': vars['sidebar-bg'],
    'topbar-bg': vars['topbar-bg'],
    'welcome-gradient': vars['welcome-gradient'],
    'element-bg': vars['element-bg'],
  });
  localStorage.setItem('customTheme', JSON.stringify(vars));
  modal.classList.add('hidden');
};
// On load: restore theme
window.addEventListener('DOMContentLoaded', function() {
  const saved = localStorage.getItem('customTheme');
  if (saved) {
    setThemeVars(JSON.parse(saved));
  }
});
</script>
@endpush --}}
@stack('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('theme-modal');
    var modalBox = document.getElementById('theme-modal-box');
    var closeBtn = document.getElementById('close-theme-modal');
    var openBtns = document.querySelectorAll('.open-theme-modal');
    openBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        modal.classList.remove('hidden');
      });
    });
    if (closeBtn) closeBtn.onclick = function() { modal.classList.add('hidden'); };
    // Only close when clicking the overlay, not the modal box
    modal.addEventListener('mousedown', function(e) {
      if (e.target === modal) {
        modal.classList.add('hidden');
      }
    });
  });
</script>
<!-- Minimal Modal Test -->
<div id="test-modal" style="display:none;position:fixed;top:20%;left:50%;transform:translateX(-50%);background:#fff;padding:2rem;z-index:9999;border:2px solid #333;">
  <button id="close-test-modal">Close</button>
  <div>Modal works!</div>
</div>
<button id="open-test-modal" style="position:fixed;bottom:2rem;right:2rem;z-index:9999;">Open Test Modal</button>
<script>
  document.getElementById('open-test-modal').onclick = function() {
    document.getElementById('test-modal').style.display = 'block';
  }
  document.getElementById('close-test-modal').onclick = function() {
    document.getElementById('test-modal').style.display = 'none';
  }
</script>

</body>
</html>
