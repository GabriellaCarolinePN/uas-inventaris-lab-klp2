<div class="sidebar">
    <h4 class="text-white mb-4">Admin Panel</h4>
    <a href="{{ route('dashboard') }}" class="{{ Request::is('admin') ? 'active' : '' }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ route('inventoris') }}" class="@if (Request::is('admin/inventoris')) active @endif"><i class="fas fa-boxes me-2"></i>Inventori</a>
    <a href="{{ route('riwayat') }}" class="@if (Request::is('admin/riwayat-peminjaman')) active @endif"><i class="fas fa-history me-2"></i>Riwayat</a>
</div>