<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - Fixed DataTable</title>
    
    <!-- Load jQuery first -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- DataTables CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-dt/2.0.3/css/dataTables.dataTables.css" rel="stylesheet">
    
    <!-- Flatpickr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --accent-color: #06b6d4;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --background-color: #f8fafc;
            --surface-color: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: var(--surface-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
            min-height: 80px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 auto;
        }

        .logo-image {
            height: 60px;
            width: auto;
            max-width: 250px;
            object-fit: contain;
            display: block;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .favorites-btn, .add-property-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .favorites-btn {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .add-property-btn {
            background: var(--primary-color);
            color: white;
        }

        .add-property-btn:hover {
            background: #1d4ed8;
            color: white;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        /* Layout */
        .layout {
            display: flex;
            min-height: calc(100vh - 80px);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--surface-color);
            border-right: 1px solid var(--border-color);
            padding: 2rem 0;
            transition: var(--transition);
        }

        .nav-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            text-decoration: none;
            color: var(--text-secondary);
            border-radius: 8px;
            transition: var(--transition);
            font-weight: 500;
        }

        .nav-link:hover {
            background: var(--background-color);
            color: var(--text-primary);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            box-shadow: var(--shadow-md);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            background: var(--surface-color);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .properties-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        /* DataTables Custom Styling */
        table.dataTable thead th {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0) !important;
            border-bottom: 2px solid var(--border-color) !important;
            color: var(--text-primary) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            padding: 1rem !important;
        }

        table.dataTable tbody tr:hover {
            background: var(--background-color) !important;
        }

        table.dataTable tbody td {
            padding: 1rem !important;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: var(--surface-color) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 6px !important;
            margin: 0 0.25rem !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: #fff !important;
            box-shadow: var(--shadow-sm) !important;
        }

        /* Filters */
        #properties-filters {
            margin-bottom: 1rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 1rem;
            background: var(--surface-color);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .filter-input {
            padding: 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
        }

        .filter-label {
            display: block;
            margin-bottom: 0.25rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* Action Button */
        .view-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--primary-color);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: var(--transition);
        }

        .view-btn:hover {
            background: #1d4ed8;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--surface-color);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--background-color), var(--border-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--text-secondary);
            font-size: 2rem;
        }

        .empty-state h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        /* Loading */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }

            .header-actions > *:not(.mobile-menu-toggle) {
                display: none;
            }

            .sidebar {
                position: fixed;
                top: 80px;
                left: 0;
                height: calc(100vh - 80px);
                z-index: 999;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="/">
                <img src="/path/to/logo.png" alt="Logo" class="logo-image">
            </a>

            <div class="header-actions">
                <button class="mobile-menu-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>

                <a href="/" class="favorites-btn">To Website</a>

                <a href="/properties/create" class="add-property-btn">
                    <i class="fas fa-plus"></i>
                    <span>Add Property</span>
                </a>
            </div>
        </div>
    </header>

    <div class="layout">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/member/dashboard" class="nav-link active">
                        <div class="nav-icon"><i class="fas fa-th-large"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ajax-nav" data-url="/member/dashboard?ajax=properties">
                        <div class="nav-icon"><i class="fas fa-home"></i></div>
                        <span>My Properties</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/properties/create" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-plus-circle"></i></div>
                        <span>Add Property</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/member/profile" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-user-cog"></i></div>
                        <span>Account Settings</span>
                    </a>
                </li>
                <li class="nav-item" style="margin-top: 2rem;">
                    <a href="/member/logout" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-sign-out-alt"></i></div>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main id="main-container" class="main-content">
            <!-- Default Dashboard Content -->
            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Welcome back! Here's what's happening with your properties.</p>
            </div>
            
            <!-- This will be replaced by AJAX content -->
            <div id="dashboard-content">
                <p>Loading dashboard...</p>
            </div>
        </main>
    </div>

    <!-- Load scripts after DOM -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-dt/2.0.3/js/dataTables.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>

    <script>
        // Global variable to track DataTable instance
        let propertiesTable = null;

        // SINGLE function to initialize DataTable - no duplicates
        function initPropertiesTable() {
            console.log('Initializing Properties Table...');
            
            // Destroy existing table if it exists
            if (propertiesTable) {
                propertiesTable.destroy();
                propertiesTable = null;
            }

            // Check if table exists
            const tableElement = $('#properties-table');
            if (tableElement.length === 0) {
                console.log('Properties table not found');
                return;
            }

            try {
                // Initialize Flatpickr for date range
                if (typeof flatpickr !== 'undefined') {
                    flatpickr("#dateRange", {
                        mode: "range",
                        dateFormat: "Y-m-d"
                    });
                }

                // Initialize DataTable
                propertiesTable = tableElement.DataTable({
                    pageLength: 10,
                    order: [[5, 'desc']], // Sort by views column
                    responsive: true,
                    language: {
                        searchPlaceholder: 'Search properties...',
                        info: "_START_-_END_ of _TOTAL_ properties",
                        emptyTable: "No properties found",
                        zeroRecords: "No matching properties found"
                    },
                    dom: '<"top"fl>rt<"bottom"ip><"clear">',
                    columnDefs: [
                        { targets: [6], orderable: false } // Action column not sortable
                    ]
                });

                // Custom search filters
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    // Only apply to our specific table
                    if (settings.nTable.id !== 'properties-table') {
                        return true;
                    }

                    // Date range filter
                    const rangeStr = $('#dateRange').val();
                    if (rangeStr && rangeStr.includes(' to ')) {
                        const [start, end] = rangeStr.split(' to ');
                        const rowDate = data[4]; // Added On column
                        if (rowDate < start || rowDate > end) {
                            return false;
                        }
                    }

                    // Minimum views filter
                    const minViews = parseInt($('#viewsMin').val(), 10) || 0;
                    const views = parseInt(data[5].replace(/[,\s]/g, ''), 10) || 0;
                    if (views < minViews) {
                        return false;
                    }

                    return true;
                });

                // Bind filter events
                $('#dateRange, #viewsMin').off('change keyup').on('change keyup', function() {
                    if (propertiesTable) {
                        propertiesTable.draw();
                    }
                });

                console.log('DataTable initialized successfully');

            } catch (error) {
                console.error('Error initializing DataTable:', error);
            }
        }

        // AJAX navigation handler
        function handleAjaxNavigation() {
            $('.ajax-nav').off('click').on('click', function(e) {
                e.preventDefault();

                const $link = $(this);
                const $menu = $('.nav-link');
                const $main = $('#main-container');
                const url = $link.data('url');

                if (!url) {
                    console.error('No URL specified for AJAX navigation');
                    return;
                }

                // Visual feedback
                $menu.removeClass('active');
                $link.addClass('active');
                $main.html('<div style="text-align: center; padding: 2rem;"><div class="loading"></div><p>Loading...</p></div>');

                // Make AJAX request
                $.get(url)
                    .done(function(html) {
                        $main.html(html);
                        
                        // Initialize DataTable after content is loaded
                        setTimeout(function() {
                            initPropertiesTable();
                        }, 100); // Small delay to ensure DOM is ready
                    })
                    .fail(function(xhr, status, error) {
                        console.error('AJAX request failed:', status, error);
                        $main.html('<div style="color: var(--error-color); text-align: center; padding: 2rem;"><p>Failed to load content. Please try again.</p></div>');
                    });
            });
        }

        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Initialize everything when DOM is ready
        $(document).ready(function() {
            console.log('DOM Ready - Initializing...');
            
            // Initialize navigation
            handleAjaxNavigation();
            
            // Check if we're on the properties page initially
            if ($('#properties-table').length > 0) {
                initPropertiesTable();
            }

            console.log('Initialization complete');
        });

        // Handle window resize for sidebar
        $(window).on('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });

        // Close sidebar when clicking outside on mobile
        $(document).on('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>

    <!-- Demo Properties Table (this would be loaded via AJAX in real implementation) -->
    <script>
        // Simulate loading properties content after a delay
        setTimeout(function() {
            const propertiesContent = `
                <div class="page-header">
                    <h1 class="page-title">My Properties</h1>
                    <p class="page-subtitle">All your active listings in one view.</p>
                </div>

                <div id="properties-filters">
                    <div>
                        <label for="dateRange" class="filter-label">Date range:</label>
                        <input id="dateRange" class="filter-input" style="width:170px" placeholder="Select date range">
                    </div>
                    <div>
                        <label for="viewsMin" class="filter-label">Min views:</label>
                        <input id="viewsMin" type="number" min="0" placeholder="0" class="filter-input" style="width:120px">
                    </div>
                </div>

                <div class="table-container">
                    <table id="properties-table" class="properties-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ref No</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Added On</th>
                                <th>30-Day Views</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>REF001</td>
                                <td>Luxury Villa in Downtown</td>
                                <td>Active</td>
                                <td>2024-01-15</td>
                                <td>1,250</td>
                                <td style="text-align:center">
                                    <a href="#" class="view-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>REF002</td>
                                <td>Modern Apartment Near Beach</td>
                                <td>Active</td>
                                <td>2024-01-20</td>
                                <td>890</td>
                                <td style="text-align:center">
                                    <a href="#" class="view-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>REF003</td>
                                <td>Cozy Family Home</td>
                                <td>Pending</td>
                                <td>2024-02-01</td>
                                <td>456</td>
                                <td style="text-align:center">
                                    <a href="#" class="view-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;
            
            // This simulates what would happen when user clicks "My Properties"
            window.loadPropertiesDemo = function() {
                $('#main-container').html(propertiesContent);
                setTimeout(() => initPropertiesTable(), 100);
            };
        }, 1000);
    </script>
</body>
</html>