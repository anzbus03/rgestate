<!-- Notifications -->
<!-- <?php if($user->email_verified == '0'): ?>
    <div class="alert alert-warning">
        Email not verified. <?php echo CHtml::link('Click here to verify your email address', Yii::app()->createUrl('user/emailverification')); ?>
    </div>
<?php endif; ?>

<?php if($user->o_verified == '0'): ?>
    <div class="alert alert-warning">
        Mobile Number not verified. <?php echo CHtml::link('Click here to verify your phone number', Yii::app()->createUrl('user/otp_verify')); ?>
    </div>
<?php endif; ?> -->

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
                                        <h4 class="property-meta">
                                            <?php echo ($property->ref_no); ?>
                                        </h4>
                                        <h4 class="property-title">
                                            <?php echo ($property->ad_title); ?>
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