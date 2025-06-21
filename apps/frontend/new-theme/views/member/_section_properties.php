<?php
$properties = PlaceAnAd::model()->userListingsWithViews([
    Yii::app()->user->id,
    '30day'
]);

?>

<style>
/* Enhanced Table Styling */
.table-container {
    background: var(--surface-color);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    margin-bottom: 2rem;
}

/* Properties Table */
.properties-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
    background: transparent;
}

/* Enhanced Table Headers */
.properties-table thead th {
    background: #1e293b !important;
    color: white !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    padding: 1.25rem 1rem !important;
    text-align: left !important;
    border: none !important;
    position: relative !important;
    font-size: 0.8rem !important;
}

.properties-table thead th::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    /* background: linear-gradient(90deg, var(--primary-color), var(--accent-color)); */
}

.properties-table thead th:first-child {
    border-top-left-radius: 16px;
}

.properties-table thead th:last-child {
    border-top-right-radius: 16px;
}

/* Table Body Styling */
.properties-table tbody td {
    padding: 1.25rem 1rem !important;
    border-bottom: 1px solid #f1f5f9 !important;
    vertical-align: middle !important;
    transition: all 0.2s ease !important;
}
/* 
.properties-table tbody tr {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    background: white;
} */

.properties-table tbody tr:hover {
    /* background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important; */
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
}

.properties-table tbody tr:nth-child(even) {
    background: #fafbfc;
}

.properties-table tbody tr:nth-child(even):hover {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%) !important;
}

/* Rank Column Styling */
.rank-cell {
    text-align: center;
    width: 60px;
}

.rank-badge {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 0.9rem;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.rank-badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.2) 0%, transparent 100%);
    border-radius: 12px;
}

.rank-1 {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
    color: #92400e;
    border: 2px solid #f59e0b;
}

.rank-2 {
    background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
    color: #374151;
    border: 2px solid #9ca3af;
}

.rank-3 {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    border: 2px solid #92400e;
}

.rank-badge:not(.rank-1):not(.rank-2):not(.rank-3) {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    color: var(--text-secondary);
    border: 2px solid var(--border-color);
}

/* Reference Number Styling */
.ref-number {
    font-family: 'JetBrains Mono', 'Monaco', 'Consolas', monospace;
    font-weight: 600;
    color: var(--primary-color);
    background: rgba(37, 99, 235, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.85rem;
    letter-spacing: 0.05em;
}

/* Property Info Column */
.property-info {
    min-width: 250px;
}

.property-title {
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.property-meta {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-secondary);
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

.property-meta .meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    background: var(--background-color);
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
}

.property-meta i {
    color: var(--primary-color);
}

/* Status Badge */
.status-badge {
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.status-active {
    background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    color: #166534;
    border: 1px solid #16a34a;
}

.status-pending {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    color: #92400e;
    border: 1px solid #f59e0b;
}

.status-inactive {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #991b1b;
    border: 1px solid #ef4444;
}

/* Date Column */
.date-cell {
    font-family: 'JetBrains Mono', 'Monaco', 'Consolas', monospace;
    font-weight: 500;
    color: var(--text-secondary);
    font-size: 0.85rem;
}

/* Views Counter */
.views-cell {
    text-align: center;
    min-width: 100px;
}

.view-count {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.count-number {
    font-size: 1.75rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1;
}

.count-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    font-weight: 600;
}

.count-trend {
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin-top: 0.25rem;
}

.trend-up {
    color: var(--success-color);
}

.trend-down {
    color: var(--error-color);
}

/* Action Button */
.action-cell {
    text-align: center;
    width: 80px;
}

.view-btn {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
    color: white;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    position: relative;
    overflow: hidden;
}

.view-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.2) 0%, transparent 100%);
    border-radius: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.view-btn:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    color: white;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
}

.view-btn:hover::before {
    opacity: 1;
}

.view-btn:active {
    transform: translateY(0) scale(0.98);
}

/* DataTables Wrapper Enhancements */
.dataTables_wrapper {
    padding: 1.5rem;
    background: var(--surface-color);
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1.5rem;
}


.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 2px solid var(--border-color) !important;
    border-radius: 8px !important;
    padding: 0.5rem 0.75rem !important;
    font-size: 0.875rem !important;
    transition: all 0.2s ease !important;
    background: white !important;
}

.dataTables_wrapper .dataTables_length select:focus,
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: var(--primary-color) !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
    outline: none !important;
}

/* Pagination Styling */
.dataTables_wrapper .dataTables_paginate {
    margin-top: 1.5rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    background: white !important;
    border: 2px solid var(--border-color) !important;
    border-radius: 8px !important;
    margin: 0 0.25rem !important;
    padding: 0.5rem 0.75rem !important;
    font-weight: 600 !important;
    transition: all 0.2s ease !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: var(--background-color) !important;
    border-color: var(--primary-color) !important;
    color: var(--primary-color) !important;
    transform: translateY(-1px) !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%) !important;
    border-color: var(--primary-color) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
}

.dataTables_wrapper .dataTables_info {
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.875rem;
}

/* Filters Enhancement */
#properties-filters {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border: 2px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    align-items: end;
    box-shadow: var(--shadow-sm);
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-label {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.filter-input {
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: white;
    min-width: 150px;
}

.filter-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
}

/* Loading State */
.table-loading {
    text-align: center;
    padding: 3rem;
    color: var(--text-secondary);
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid var(--border-color);
    border-top: 4px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 1rem;
}

/* Empty State Enhancement */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 16px;
    border: 2px dashed var(--border-color);
}

.empty-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 8px 32px rgba(37, 99, 235, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .properties-table {
        font-size: 0.875rem;
    }
    
    .properties-table thead th,
    .properties-table tbody td {
        padding: 0.75rem 0.5rem !important;
    }
    
    .property-title {
        font-size: 0.9rem;
    }
    
    .count-number {
        font-size: 1.5rem;
    }
    
    .rank-badge {
        width: 36px;
        height: 36px;
        font-size: 0.8rem;
    }
    
    .view-btn {
        width: 40px;
        height: 40px;
    }
    
    #properties-filters {
        flex-direction: column;
        gap: 1rem;
    }
    
    .filter-input {
        min-width: 100%;
    }
}

@media (max-width: 480px) {
    .dataTables_wrapper {
        padding: 1rem;
    }
    
    .table-container {
        margin: 0 -1rem;
        border-radius: 0;
        border-left: none;
        border-right: none;
    }
    
    .properties-table thead th:first-child,
    .properties-table tbody td:first-child {
        padding-left: 1rem !important;
    }
    
    .properties-table thead th:last-child,
    .properties-table tbody td:last-child {
        padding-right: 1rem !important;
    }
}
/* Fixed DataTables Wrapper Styling */
.dataTables_wrapper {
    padding: 1.5rem;
    background: var(--surface-color);
}

/* Top Controls (Length and Search) */
.dataTables_wrapper .dataTables_length {
    float: left;
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_filter {
    float: right;
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_length label,
.dataTables_wrapper .dataTables_filter label {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.dataTables_wrapper .dataTables_length select {
    border: 2px solid var(--border-color) !important;
    border-radius: 8px !important;
    padding: 0.5rem 2rem 0.5rem 0.75rem !important;
    font-size: 0.875rem !important;
    transition: all 0.2s ease !important;
    background: white url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e") no-repeat right 0.5rem center/1.5em 1.5em !important;
    appearance: none !important;
    min-width: 80px !important;
    margin: 0 0.5rem !important;
}

.dataTables_wrapper .dataTables_filter input {
    border: 2px solid var(--border-color) !important;
    border-radius: 8px !important;
    padding: 0.5rem 1rem !important;
    font-size: 0.875rem !important;
    transition: all 0.2s ease !important;
    background: white !important;
    min-width: 200px !important;
    margin-left: 0.5rem !important;
}

.dataTables_wrapper .dataTables_length select:focus,
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: var(--primary-color) !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
    outline: none !important;
}

/* Clear floats after top controls */
.dataTables_wrapper .dataTables_length::after,
.dataTables_wrapper .dataTables_filter::after {
    content: "";
    display: table;
    clear: both;
}

/* Info and Pagination at bottom */
.dataTables_wrapper .dataTables_info {
    float: left;
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.875rem;
    margin-top: 1rem;
    padding-top: 0.5rem;
}

.dataTables_wrapper .dataTables_paginate {
    float: right;
    margin-top: 1rem;
}

/* Clear floats after bottom controls */
.dataTables_wrapper::after {
    content: "";
    display: table;
    clear: both;
}

/* Pagination Buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    background: white !important;
    border: 2px solid var(--border-color) !important;
    border-radius: 8px !important;
    margin: 0 0.25rem !important;
    padding: 0.5rem 0.75rem !important;
    font-weight: 600 !important;
    transition: all 0.2s ease !important;
    color: var(--text-secondary) !important;
    text-decoration: none !important;
    display: inline-block !important;
    min-width: 40px !important;
    text-align: center !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
    background: var(--background-color) !important;
    border-color: var(--primary-color) !important;
    color: var(--primary-color) !important;
    transform: translateY(-1px) !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%) !important;
    border-color: var(--primary-color) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: 0.5 !important;
    cursor: not-allowed !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    background: white !important;
    border-color: var(--border-color) !important;
    color: var(--text-secondary) !important;
    transform: none !important;
}

/* Enhanced Top Bar */
.dataTables_top_bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.dataTables_top_bar .length-control {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.dataTables_top_bar .search-control {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        float: none !important;
        text-align: center !important;
        margin-bottom: 1rem !important;
    }
    
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        float: none !important;
        text-align: center !important;
        margin-top: 1rem !important;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        min-width: 150px !important;
    }
    
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        flex-direction: column !important;
        gap: 0.25rem !important;
    }
}

@media (max-width: 480px) {
    .dataTables_wrapper {
        padding: 1rem;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        min-width: 120px !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.4rem 0.6rem !important;
        font-size: 0.8rem !important;
        min-width: 35px !important;
    }
}

/* Fix for custom DOM structure */
.dataTables_wrapper .top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.dataTables_wrapper .bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

/* Override any conflicting styles */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    margin: 0 !important;
}

/* Search input placeholder */
.dataTables_wrapper .dataTables_filter input::placeholder {
    color: var(--text-secondary);
    opacity: 0.7;
}

/* Focus states */
.dataTables_wrapper .dataTables_filter input:focus::placeholder {
    opacity: 0.5;
}

/* Custom styling for "Show entries" text */
.dataTables_wrapper .dataTables_length label {
    white-space: nowrap;
}

.dataTables_wrapper .dataTables_filter label {
    white-space: nowrap;
}
/* Layout */
div.dt-layout-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

/* Entries-per-page */
div.dt-length {
  display: flex;
  margin-left: 20px;
  align-items: center;
  gap: 0.5rem;
}
div.dt-length select.dt-input {
  padding: 0.4rem 0.75rem;
  border: 1px solid var(--border-color);
  border-radius: 6px;
  background: var(--surface-color);
  font-size: 0.875rem;
}
div.dt-length label {
  padding-top: 6px;
  font-size: 0.875rem;
  color: var(--text-secondary);
}

/* Search */
div.dt-search {
  align-items: right;
  margin-right: 20px;
  gap: 0.5rem;
}
div.dt-search label {
    display: none;
}
div.dt-search input.dt-input {
  padding: 0.4rem 0.75rem;
  width: 50%;
  border-radius: 6px;
  background: var(--surface-color);
  font-size: 0.875rem;
}

/* Focus states */
div.dt-length select.dt-input:focus,
div.dt-search input.dt-input:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

/* Mobile: stack */
@media (max-width: 600px) {
  div.dt-layout-row {
    flex-direction: column;
    align-items: stretch;
    gap: 0.75rem;
  }
}
#properties-table_info{
    margin-left: 10px;
}
.dt-paging-button{
    display: none !important;
}

</style>
<div class="page-header">
    <h1 class="page-title">My Properties</h1>
    <p class="page-subtitle">Manage and track your property listings</p>
</div>

<?php if ($properties): ?>
 

    <div class="table-container">
        <table id="properties-table" class="properties-table">
            <thead>
                <tr>
                    <th class="rank-cell">#</th>
                    <th>Reference</th>
                    <th>Property Title</th>
                    <th>Status</th>
                    <th>Added On</th>
                    <th class="views-cell">Performance</th>
                    <th class="action-cell">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($properties as $n => $p): ?>
                <tr class="property-row">
                    <td class="rank-cell">
                        <div class="rank-badge <?= $n < 3 ? 'rank-'.($n+1) : '' ?>">
                            <?= $n+1 ?>
                        </div>
                    </td>
                    <td>
                        <span class="ref-number"><?php echo ($p->RefNo == null? $p->id : $p->RefNo) ?></span>
                    </td>
                    <td class="property-info">
                        <h4 class="property-title"><?= CHtml::encode($p->ad_title) ?></h4>
                       
                    </td>
                    <td>
                        <span class="status-badge status-<?= $p->status === 'A' ? 'active' : 'pending' ?>">
                            <i class="fas fa-<?= $p->status === 'A' ? 'check-circle' : 'clock' ?>"></i>
                            <?= $p->status === 'A' ? 'Active' : 'Pending' ?>
                        </span>
                    </td>
                    <td class="date-cell">
                        <?= date('Y-m-d', strtotime($p->date_added)) ?>
                    </td>
                    <td class="views-cell">
                        <div class="view-count">
                            <span class="count-number"><?= number_format($p->total_views ?? 0) ?></span>
                            <span class="count-label">30-day views</span>
                       
                        </div>
                    </td>
                    <td class="action-cell">
                        <a href="<?= Yii::app()->createUrl('/id-' . $p->id); ?>"
                           class="view-btn" title="View Property">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-home"></i>
        </div>
        <h4>No Properties Yet</h4>
        <p>Start building your property portfolio by adding your first listing.</p>
        <a href="<?= Yii::app()->createUrl('properties/create'); ?>" class="add-property-btn">
            <i class="fas fa-plus"></i> Add Your First Property
        </a>
    </div>
<?php endif; ?>