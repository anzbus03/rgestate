<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
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

                <a href="<?php echo Yii::app()->createUrl('properties/create'); ?>" class="add-property-btn">
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
                    <a href="<?php echo Yii::app()->createUrl('properties/index'); ?>" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <span>My Properties</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo Yii::app()->createUrl('properties/create'); ?>" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <span>Add Property</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo Yii::app()->createUrl('member/profile'); ?>" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <span>Account Settings</span>
                    </a>
                </li>
                <li class="nav-item" style="margin-top: 2rem;">
                    <a href="<?php echo Yii::app()->createUrl('member/logout'); ?>" class="nav-link">
                        <div class="nav-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Notifications -->
            <?php if($user->email_verified == '0'): ?>
                <div class="alert alert-warning">
                    Email not verified. <?php echo CHtml::link('Click here to verify your email address', Yii::app()->createUrl('user/emailverification')); ?>
                </div>
            <?php endif; ?>

            <?php if($user->o_verified == '0'): ?>
                <div class="alert alert-warning">
                    Mobile Number not verified. <?php echo CHtml::link('Click here to verify your phone number', Yii::app()->createUrl('user/otp_verify')); ?>
                </div>
            <?php endif; ?>

            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Welcome back, <?php echo CHtml::encode($user->fullName); ?>! Here's what's happening with your properties.</p>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Properties</span>
                        <div class="stat-icon primary">
                            <i class="fas fa-home"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?php echo ($active_properties); ?></div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>Total active listings</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Page Views (30 Days)</span>
                        <div class="stat-icon success">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($last_30_Days_pageviews->s_count); ?></div>
                    <div class="stat-change positive">
                        <i class="fas fa-chart-line"></i>
                        <span>Property page views</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Phone Calls (30 Days)</span>
                        <div class="stat-icon info">
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($last_30_Days_callCount->s_count); ?></div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>Contact inquiries</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Email Inquiries</span>
                        <div class="stat-icon warning">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?php echo number_format($enqTotal); ?></div>
                    <div class="stat-change positive">
                        <i class="fas fa-envelope-open"></i>
                        <span>Total inquiries received</span>
                    </div>
                </div>
            </div>


			<!-- Top-5 Page Views -->
			<div class="content-card" style="margin-bottom: 2rem;">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-trophy" style="color: var(--warning-color); margin-right: 0.5rem;"></i>
						Top 5 Properties by Views (Last 30 Days)
					</h3>
				</div>
				<div class="card-content" style="padding: 0;">
					<?php if (!empty($topViews)): ?>
						<div class="table-container">
							<table class="properties-table">
								<thead>
									<tr>
										<th style="width: 60px;">Rank</th>
										<th>Property</th>
										<th style="width: 120px; text-align: center;">Total Views</th>
										<th style="width: 100px; text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($topViews as $index => $property): ?>
										<tr class="property-row">
											<td class="rank-cell">
												<div class="rank-badge rank-<?php echo $index + 1; ?>">
													<?php if ($index == 0): ?>
														<i class="fas fa-crown"></i>
													<?php elseif ($index == 1): ?>
														<i class="fas fa-medal"></i>
													<?php elseif ($index == 2): ?>
														<i class="fas fa-award"></i>
													<?php else: ?>
														<?php echo $index + 1; ?>
													<?php endif; ?>
												</div>
											</td>
											<td class="property-cell">
												<div class="property-info">
													<h4 class="property-title">
														Property ID: <?php echo $property->property_id; ?>
													</h4>
													<p class="property-meta">
														<i class="fas fa-calendar-alt"></i>
														Last 30 days performance
													</p>
												</div>
											</td>
											<td class="views-cell">
												<div class="view-count">
													<span class="count-number"><?php echo number_format($property->total_views); ?></span>
													<span class="count-label">views</span>
												</div>
											</td>
											<td class="action-cell">
												<a href="<?php echo Yii::app()->createUrl('/id-' . $property->property_id); ?>" 
												class="view-btn" 
												title="View Property">
													<i class="fas fa-eye"></i>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<div class="empty-state">
							<div class="empty-icon">
								<i class="fas fa-chart-line"></i>
							</div>
							<h4>No View Data Available</h4>
							<p>Start promoting your properties to see view statistics here.</p>
							<a href="<?php echo Yii::app()->createUrl('properties/create'); ?>" class="add-property-btn">
								<i class="fas fa-plus"></i>
								Add Your First Property
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
                <!-- Quick Actions -->
              
            <!-- </div> -->

            <!-- Plans Section -->
            
        </main>
    </div>

    <script>
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
    </script>
</body>
</html>