<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- jQuery -->
   
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

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text-primary);
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

        .language-toggle {
            padding: 0.5rem 1rem;
            background: var(--background-color);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: var(--transition);
        }

        .language-toggle:hover {
            background: var(--surface-color);
            color: var(--text-primary);
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

        .favorites-btn:hover {
            background: var(--background-color);
            color: var(--error-color);
        }

        .add-property-btn {
            background: var(--primary-color);
            color: white;
        }

        .add-property-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .user-trigger:hover {
            background: var(--background-color);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--border-color);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--text-primary);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Mobile Menu Toggle */
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

        .sidebar.hidden {
            transform: translateX(-100%);
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

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .page-header {
            margin-bottom: 2rem;
            margin-top: 0px;
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

        /* Notification Alert */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .alert-warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        .alert a {
            color: #1d4ed8;
            text-decoration: underline;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--surface-color);
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-title {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.125rem;
        }

        .stat-icon.primary { background: linear-gradient(135deg, var(--primary-color), #3b82f6); }
        .stat-icon.success { background: linear-gradient(135deg, var(--success-color), #22c55e); }
        .stat-icon.warning { background: linear-gradient(135deg, var(--warning-color), #fbbf24); }
        .stat-icon.info { background: linear-gradient(135deg, var(--accent-color), #0ea5e9); }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
        }

        .stat-change.positive { color: var(--success-color); }
        .stat-change.negative { color: var(--error-color); }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .content-card {
            background: var(--surface-color);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .card-content {
            padding: 1.5rem;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            gap: 1rem;
        }

        .action-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--background-color);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-primary);
            transition: var(--transition);
        }

        .action-item:hover {
            background: var(--border-color);
            transform: translateX(4px);
        }

        .action-icon {
            width: 40px;
            height: 40px;
            background: var(--surface-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .action-content h4 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .action-content p {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Recent Activity */
        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--background-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .activity-description {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 1rem;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .header-actions > *:not(.mobile-menu-toggle):not(.user-dropdown) {
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

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }

        /* Loading Animation */
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

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--error-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
		/* Table Styles */
		.table-container {
			overflow-x: auto;
		}

		.properties-table {
			width: 100%;
			border-collapse: collapse;
			font-size: 0.95rem;
		}

		.properties-table thead th {
			background: linear-gradient(135deg, #f8fafc, #e2e8f0);
			color: var(--text-primary);
			font-weight: 600;
			padding: 1rem;
			text-align: left;
			border-bottom: 2px solid var(--border-color);
			font-size: 0.875rem;
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}

		.properties-table tbody td {
			padding: 1rem;
			border-bottom: 1px solid var(--border-color);
			vertical-align: middle;
		}

		.property-row {
			transition: var(--transition);
		}

		.property-row:hover {
			background: var(--background-color);
		}

		/* Rank Badge */
		.rank-cell {
			text-align: center;
		}

		.rank-badge {
			width: 36px;
			height: 36px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: 700;
			font-size: 0.875rem;
			margin: 0 auto;
		}

		.rank-1 {
			background: linear-gradient(135deg, #ffd700, #ffed4e);
			color: #92400e;
			box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
		}

		.rank-2 {
			background: linear-gradient(135deg, #c0c0c0, #e5e7eb);
			color: #374151;
			box-shadow: 0 4px 12px rgba(192, 192, 192, 0.3);
		}

		.rank-3 {
			background: linear-gradient(135deg, #cd7f32, #f59e0b);
			color: white;
			box-shadow: 0 4px 12px rgba(205, 127, 50, 0.3);
		}

		.rank-badge:not(.rank-1):not(.rank-2):not(.rank-3) {
			background: var(--background-color);
			color: var(--text-secondary);
			border: 2px solid var(--border-color);
		}

		/* Property Info */
		.property-info {
			min-width: 200px;
		}

		.property-title {
			font-weight: 600;
			color: var(--text-primary);
			margin: 0 0 0.25rem 0;
			font-size: 0.95rem;
		}

		.property-meta {
			color: var(--text-secondary);
			font-size: 0.8rem;
			margin: 0;
			display: flex;
			align-items: center;
			gap: 0.375rem;
		}

		/* View Count */
		.views-cell {
			text-align: center;
		}

		.view-count {
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		.count-number {
			font-size: 1.5rem;
			font-weight: 700;
			color: var(--primary-color);
			line-height: 1;
		}

		.count-label {
			font-size: 0.75rem;
			color: var(--text-secondary);
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}

		/* Action Button */
		.action-cell {
			text-align: center;
		}

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
			transform: translateY(-1px);
			box-shadow: var(--shadow-md);
			color: white;
		}

		/* Empty State */
		.empty-state {
			text-align: center;
			padding: 3rem 2rem;
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

		/* Responsive Design */
		@media (max-width: 768px) {
			.properties-table {
				font-size: 0.875rem;
			}
			
			.properties-table thead th,
			.properties-table tbody td {
				padding: 0.75rem 0.5rem;
			}
			
			.property-title {
				font-size: 0.875rem;
			}
			
			.count-number {
				font-size: 1.25rem;
			}
			
			.rank-badge {
				width: 32px;
				height: 32px;
				font-size: 0.75rem;
			}
		}

		@media (max-width: 480px) {
			.table-container {
				margin: 0 -1rem;
			}
			
			.properties-table thead th:first-child,
			.properties-table tbody td:first-child {
				padding-left: 1rem;
			}
			
			.properties-table thead th:last-child,
			.properties-table tbody td:last-child {
				padding-right: 1rem;
			}
		}
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="/">
                <img src="<?php echo Yii::app()->apps->getBaseUrl($this->logo_path); ?>" alt="Logo" class="logo-image">
            </a>

            <div class="header-actions">
                <button class="mobile-menu-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>

                <a href="/" class="favorites-btn">To Website</a>

                <a href="<?php echo Yii::app()->createUrl('submit/property'); ?>" target="_blank" class="add-property-btn">
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
                    <a href="<?php echo Yii::app()->createUrl('member/dashboard'); ?>" class="nav-link active">
                        <div class="nav-icon">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  href="#"
                        class="nav-link ajax-nav"
                        data-url="<?php echo Yii::app()->createUrl('member/dashboard',
                                        ['ajax' => 'properties']); ?>">
                        <div class="nav-icon"><i class="fas fa-home"></i></div>
                        <span>My Properties</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo Yii::app()->createUrl('submit/property'); ?>" target="_blank" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <span>Add Property</span>
                    </a>
                </li>
               <li class="nav-item">
                    <a href="#"
                        class="nav-link ajax-nav"
                        data-url="<?= Yii::app()->createUrl('member/dashboard', ['ajax'=>'personal']); ?>">
                        <div class="nav-icon"><i class="fas fa-id-card"></i></div>
                        <span>Personal Information</span>
                    </a>
                </li>
                <li class="nav-item" >
                    <a href="javascript:void(0)" class="nav-link">
                    <?php echo CHtml::beginForm(Yii::app()->createUrl('member/logout'), 'post', [
                        'style'=>'display:inline;'
                    ]); ?>
                        <button type="submit" class="nav-link" 
                                style="background:none;border:none;padding:0;cursor:pointer;">
                        <div class="nav-icon"><i class="fas fa-sign-out-alt"></i></div>
                        <span>Sign Out</span>
                        </button>
                    <?php echo CHtml::endForm(); ?>
                    </a>
                </li>
               
            </ul>
        </nav>

        <!-- Main Content -->
        <main id="main-container" class="main-content">
            <?php $this->renderPartial('_section_dashboard', compact(
                'active_properties',
                'last_30_Days_pageviews',
                'last_30_Days_callCount',
                'last_30_Days_mailCount',
                'enqTotal',
                'topViews',
                'user'
            )); ?>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- DataTables 2 core -->
    <!-- <link  href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-dt/2.0.3/css/dataTables.dataTables.css" rel="stylesheet"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-dt/2.0.3/js/dataTables.dataTables.min.js"></script>

    <!-- Flatpickr -->
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script>
// Global variable to track DataTable instance
let propertiesTable = null;

// Function to load DataTables library with fallback CDNs
function loadDataTablesLibrary() {
    return new Promise((resolve, reject) => {
        // Check if DataTables is already loaded
        if (typeof $.fn.DataTable !== 'undefined') {
            console.log('DataTables already loaded');
            resolve();
            return;
        }

        console.log('Loading DataTables library...');
        
        // Multiple CDN fallbacks
        const cdnUrls = [
            'https://cdn.datatables.net/2.0.3/js/dataTables.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/datatables.net-dt/2.0.3/js/dataTables.dataTables.min.js',
            'https://cdn.jsdelivr.net/npm/datatables.net@2.0.3/js/dataTables.min.js'
        ];

        const cssUrls = [
            'https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/datatables.net-dt/2.0.3/css/dataTables.dataTables.min.css'
        ];

        // Load CSS first
        if (!$('link[href*="dataTables"]').length) {
            $('<link>', {
                rel: 'stylesheet',
                type: 'text/css',
                href: cssUrls[0]
            }).appendTo('head');
        }

        // Try loading from multiple CDNs
        function tryLoadScript(urls, index = 0) {
            if (index >= urls.length) {
                reject(new Error('All CDN attempts failed'));
                return;
            }

            console.log(`Trying CDN ${index + 1}: ${urls[index]}`);
            
            $.getScript(urls[index])
                .done(function() {
                    // Verify DataTables loaded correctly
                    if (typeof $.fn.DataTable !== 'undefined') {
                        console.log('DataTables library loaded successfully from CDN', index + 1);
                        resolve();
                    } else {
                        console.log('DataTables loaded but not available, trying next CDN...');
                        tryLoadScript(urls, index + 1);
                    }
                })
                .fail(function() {
                    console.log(`CDN ${index + 1} failed, trying next...`);
                    tryLoadScript(urls, index + 1);
                });
        }

        tryLoadScript(cdnUrls);
    });
}

// Function to load Flatpickr library
function loadFlatpickrLibrary() {
    return new Promise((resolve, reject) => {
        if (typeof flatpickr !== 'undefined') {
            console.log('Flatpickr already loaded');
            resolve();
            return;
        }

        console.log('Loading Flatpickr library...');

        // Load Flatpickr CSS
        if (!$('link[href*="flatpickr"]').length) {
            $('<link>', {
                rel: 'stylesheet',
                type: 'text/css',
                href: 'https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css'
            }).appendTo('head');
        }

        // Load Flatpickr JS
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js')
            .done(function() {
                console.log('Flatpickr library loaded successfully');
                resolve();
            })
            .fail(function() {
                console.log('Flatpickr failed to load, continuing without date picker');
                resolve(); // Don't fail the whole process for flatpickr
            });
    });
}

// Fallback: Load libraries from static script tags if dynamic loading fails
function loadLibrariesFallback() {
    console.log('Using fallback method to load libraries...');
    
    // Add script tags to head
    const datatablesCss = document.createElement('link');
    datatablesCss.rel = 'stylesheet';
    datatablesCss.href = 'https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css';
    document.head.appendChild(datatablesCss);

    const datatablesJs = document.createElement('script');
    datatablesJs.src = 'https://cdn.datatables.net/2.0.3/js/dataTables.min.js';
    
    return new Promise((resolve, reject) => {
        datatablesJs.onload = function() {
            console.log('DataTables loaded via fallback method');
            // Wait a bit for the library to initialize
            setTimeout(() => {
                if (typeof $.fn.DataTable !== 'undefined') {
                    resolve();
                } else {
                    reject(new Error('DataTables still not available after fallback'));
                }
            }, 500);
        };
        
        datatablesJs.onerror = function() {
            reject(new Error('Fallback method also failed'));
        };
        
        document.head.appendChild(datatablesJs);
    });
}

// Initialize DataTable with comprehensive error handling
async function initPropertiesTable() {
    console.log('Initializing Properties Table...');
    
    try {
        // Check if table exists first
        const tableElement = $('#properties-table');
        if (tableElement.length === 0) {
            console.log('Properties table not found');
            return;
        }

        // Destroy existing table if it exists
        if (propertiesTable && typeof propertiesTable.destroy === 'function') {
            console.log('Destroying existing DataTable instance');
            propertiesTable.destroy();
            propertiesTable = null;
        }

        // Try to load libraries
        try {
            await Promise.all([
                loadDataTablesLibrary(),
                loadFlatpickrLibrary()
            ]);
        } catch (error) {
            console.log('Dynamic loading failed, trying fallback method...');
            await loadLibrariesFallback();
        }

        // Final check if DataTables is available
        if (typeof $.fn.DataTable === 'undefined') {
            throw new Error('DataTables library could not be loaded from any source');
        }

        console.log('Libraries loaded successfully, initializing DataTable...');

        // Initialize Flatpickr for date range if available
        if (typeof flatpickr !== 'undefined' && document.getElementById('dateRange')) {
            // Destroy existing flatpickr instance
            const dateRangeElement = document.querySelector('#dateRange');
            if (dateRangeElement && dateRangeElement._flatpickr) {
                dateRangeElement._flatpickr.destroy();
            }
            
            flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                allowInput: true
            });
        }

        // Clear any existing search extensions for this table
        if ($.fn.dataTable.ext.search.length > 0) {
            $.fn.dataTable.ext.search = $.fn.dataTable.ext.search.filter(function(fn) {
                return fn.name !== 'propertiesTableSearch';
            });
        }

        // Initialize DataTable
        propertiesTable = tableElement.DataTable({
            pageLength: 10,
            order: [[5, 'ASC']], // Sort by views column
            responsive: true,
            destroy: true, // Allow reinitialization
            language: {
                searchPlaceholder: 'Search properties...',
                info: "_START_-_END_ of _TOTAL_ properties",
                emptyTable: "No properties found",
                zeroRecords: "No matching properties found",
                loadingRecords: "Loading...",
                processing: "Processing..."
            },
            // dom: '<"top"fl>rt<"bottom"ip><"clear">',
            columnDefs: [
                { targets: [6], orderable: false } // Action column not sortable
            ]
        });

        // Add custom search function with name for identification
        const customSearchFunction = function(settings, data, dataIndex) {
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
        };

        // Add name property for identification
        customSearchFunction.name = 'propertiesTableSearch';
        $.fn.dataTable.ext.search.push(customSearchFunction);

        // Bind filter events
        $('#dateRange, #viewsMin').off('change keyup input').on('change keyup input', function() {
            if (propertiesTable) {
                propertiesTable.draw();
            }
        });

        console.log('DataTable initialized successfully');

    } catch (error) {
        console.error('Error initializing DataTable:', error);
        
        // Show user-friendly error message
        const tableContainer = $('.table-container');
        if (tableContainer.length > 0) {
            tableContainer.html(`
                <div style="text-align: center; padding: 2rem; color: #ef4444; background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 1rem; color: #dc2626;"></i>
                    <h4 style="margin-bottom: 0.5rem;">Table Loading Error</h4>
                    <p style="margin-bottom: 1rem;">Unable to load the data table library. This might be due to network issues or browser restrictions.</p>
                    <div style="margin-bottom: 1rem;">
                        <strong>Possible solutions:</strong><br>
                        • Check your internet connection<br>
                        • Disable ad blockers temporarily<br>
                        • Try refreshing the page
                    </div>
                    <button onclick="location.reload()" style="margin-top: 1rem; padding: 0.75rem 1.5rem; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                        <i class="fas fa-redo"></i> Refresh Page
                    </button>
                </div>
            `);
        }
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
                setTimeout(async function() {
                    try {
                        await initPropertiesTable();
                    } catch (error) {
                        console.error('Failed to initialize DataTable after AJAX:', error);
                    }
                }, 200); // Slightly longer delay for AJAX content
            })
            .fail(function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                $main.html('<div style="color: #ef4444; text-align: center; padding: 2rem;"><p>Failed to load content. Please try again.</p></div>');
            });
    });
}

// Sidebar toggle
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        sidebar.classList.toggle('show');
    }
}

// Initialize everything when DOM is ready
$(document).ready(function() {
    console.log('DOM Ready - Initializing...');
    console.log('jQuery version:', $.fn.jquery);
    
    // Initialize navigation
    handleAjaxNavigation();
    
    // Check if we're on the properties page initially
    if ($('#properties-table').length > 0) {
        console.log('Properties table found, initializing...');
        initPropertiesTable().catch(error => {
            console.error('Failed to initialize properties table:', error);
        });
    } else {
        console.log('Properties table not found on initial load');
    }

    console.log('Initialization complete');
});

// Handle window resize for sidebar
$(window).on('resize', function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar && window.innerWidth > 768) {
        sidebar.classList.remove('show');
    }
});

// Close sidebar when clicking outside on mobile
$(document).on('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.querySelector('.mobile-menu-toggle');
    
    if (window.innerWidth <= 768 && sidebar && toggle &&
        !sidebar.contains(event.target) && 
        !toggle.contains(event.target)) {
        sidebar.classList.remove('show');
    }
});

// Debug function to check library status
window.checkLibraryStatus = function() {
    console.log('=== Library Status ===');
    console.log('jQuery available:', typeof $ !== 'undefined');
    console.log('jQuery version:', typeof $ !== 'undefined' ? $.fn.jquery : 'N/A');
    console.log('DataTables available:', typeof $.fn.DataTable !== 'undefined');
    console.log('Flatpickr available:', typeof flatpickr !== 'undefined');
    console.log('Properties table exists:', $('#properties-table').length > 0);
    console.log('Current DataTable instance:', propertiesTable);
};
</script>
    <!-- <script>
        function initPropertiesTable () {

            flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d"
            });

            const table = $('#properties-table').DataTable({
                pageLength: 10,
                order: [[5,'desc']],
                responsive: true,
                language: {
                    searchPlaceholder: 'Search…',
                    info: "_START_-_END_ of _TOTAL_ properties"
                }
            });

            // custom filters
            $.fn.dataTable.ext.search.push(function (settings, data) {
                const rangeStr = $('#dateRange').val();
                if (rangeStr){
                    const [start, end] = rangeStr.split(' to ');
                    const rowDate = data[4];
                    if (rowDate < start || rowDate > end) return false;
                }
                const min = parseInt($('#viewsMin').val(),10) || 0;
                const views = parseInt(data[5].replace(/[, ]/g,''),10) || 0;
                return views >= min;
            });

            $('#dateRange, #viewsMin').on('change keyup', () => table.draw());
        }
        document.addEventListener('DOMContentLoaded', function () {
            $('.ajax-nav').on('click', function (e) {
                e.preventDefault();

                const $link  = $(this);
                const $menu  = $('.nav-link');              // all menu items
                const $main  = $('#main-container');

                // visual feedback
                $menu.removeClass('active');
                $link.addClass('active');
                $main.html('<div class="loading"></div>');
              
                $.get($link.data('url'), function (html) {
                    $main.html(html);
                    initPropertiesTable();  
                }).fail(function () {
                    $main.html('<p style="color:#ef4444">Failed to load.</p>');
                });
            });
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });

        // Initialize any dynamic content
        document.addEventListener('DOMContentLoaded', function() {
            // Add any initialization code here
            console.log('Dashboard loaded for user: <?php echo CHtml::encode($user->fullName); ?>');
        });
    </script> -->
</body>
</html>