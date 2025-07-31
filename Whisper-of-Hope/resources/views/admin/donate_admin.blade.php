@extends('admin.layout.app')

@section('title', __('donation.page_title_index'))

@section('content')
<div class="hair-donations-management" style="display: flex; flex-direction: column; align-items: center;">
    <div class="page-header" style="justify-content: center; margin-left: 0; width: 100%;">
        <div style="flex: 1;"></div>
        {{-- BAGIAN SEARCH DIUBAH: Form dihapus, hanya input dan ikon untuk pencarian client-side --}}
        <div class="search-container" style="justify-content: center; display: flex; width: 100%; max-width: 300px;">
            <input type="text"
                id="searchInput"
                placeholder="{{ __('donation.search_placeholder') }}"
                style="width: 100%; min-width: 300px; max-width: 100%; padding-right: 45px;">
            <img src="{{ asset('images/admin/user_admin/search.png') }}" class="search-icon" alt="{{ __('donation.search_placeholder') }}">
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" id="successAlert" style="text-align: left;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="errorAlert" style="text-align: left;">
            {{ session('error') }}
        </div>
    @endif

    <div class="donations-table-container" >
        <table class="donations-table">
            <thead>
                <tr>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 8%; text-align: center;">{{ __('donation.donation_id') }}</th>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 16%; text-align: center;">{{ __('donation.full_name') }}</th>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 6%; text-align: center;">{{ __('donation.age') }}</th>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 20%; text-align: center;">{{ __('donation.email') }}</th>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 14%; text-align: center;">{{ __('donation.phone_number') }}</th>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 12%; text-align: center;">{{ __('donation.hair_length') }}</th>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 10%; text-align: center;">{{ __('donation.status') }}</th>
                    <th class="{{ app()->getLocale() === 'id' ? 'id-th-small' : '' }}" style="width: 20%; text-align: center;">{{ __('donation.actions') }}</th>
                </tr>
            </thead>
            {{-- ID dan class ditambahkan untuk target JavaScript --}}
            <tbody id="donationsTableBody">
                @forelse($hairDonations as $donation)
                <tr class="donation-row" onclick="window.location='{{ route('admin.donations.show', ['hairDonation' => $donation->id]) }}'" style="cursor: pointer;">
                    <td style="text-align: center;">{{ $donation->id }}</td>
                    <td style="text-align: center;">{{ $donation->full_name }}</td>
                    <td style="text-align: center;">{{ $donation->age ?? __('donation.na') }}</td>
                    <td style="text-align: center;">{{ $donation->email }}</td>
                    <td style="text-align: center;">{{ $donation->phone ?? __('donation.na') }}</td>
                    <td style="text-align: center;">{{ $donation->hair_length ?? __('donation.na') }} cm</td>
                    <td style="text-align: center;">
                        @php
                            $status = strtolower($donation->status);
                            $statusImages = [
                                'waiting' => asset('images/Donate_hair/waiting.png'),
                                'received' => asset('images/Donate_hair/accept-solid.png'),
                                'missing' => asset('images/Donate_hair/reject-solid.png'),
                            ];
                            $statusImage = $statusImages[$status] ?? null;
                        @endphp
                        <div style="display: flex; align-items: center; gap: 3px; justify-content: center;">
                            <span class="status-badge status-{{ str_replace(' ', '-', $status) }}" @if($donation->status == 'waiting') disabled @endif>
                                @if($statusImage)
                                    @php
                                        $imgSize = ($status === 'waiting') ? 15 : 16;
                                    @endphp
                                    <img src="{{ $statusImage }}" alt="{{ __('donation.status_label_' . $status) }}" style="width:{{ $imgSize }}px; height:{{ $imgSize }}px;">
                                @endif
                                {{ __('donation.status_label_' . $status) }}
                            </span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="action-buttons" style="justify-content: center;" onclick="event.stopPropagation();">
                            {{-- Approve Button --}}
                            <button class="action-btn approve-btn" onclick="confirmAction('{{ $donation->id }}', 'approve')"
                                @if(strtolower($donation->status) === 'received') disabled @endif>
                                <img src="{{ asset('images/Donate_hair/' . (strtolower($donation->status) === 'received' ? 'accept-solid.png' : 'admin_received.svg')) }}" alt="{{ __('donation.approve') }}">
                            </button>

                            {{-- Reject Button --}}
                            <button class="action-btn reject-btn" onclick="confirmAction('{{ $donation->id }}', 'reject')"
                                @if(strtolower($donation->status) === 'missing') disabled @endif>
                                <img src="{{ asset('images/Donate_hair/' . (strtolower($donation->status) === 'missing' ? 'reject-solid.png' : 'reject-outline.png')) }}" style = "width: 18px;" alt="{{ __('donation.reject') }}">
                            </button>
                            <button class="action-btn delete-btn" onclick="deleteHairDonation('{{ $donation->id }}')">
                                <img src="{{ asset('images/Donate_hair/admin_hapus.svg') }}" alt="{{ __('donation.delete') }}">
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                {{-- Kosong, karena baris "no-data" akan ditangani oleh JS di bawah --}}
                @endforelse
                {{-- Baris "tidak ada data" ini dikontrol sepenuhnya oleh JavaScript --}}
                <tr id="no-data-row" style="display: none;">
                    <td colspan="8" class="no-data" style="text-align: center; vertical-align: middle;">
                         {{ __('donation.no_donations_found') }}
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Catatan: Pagination hanya berlaku untuk data yang dimuat awal. Pencarian client-side tidak akan mempengaruhi pagination. --}}
        @if($hairDonations->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    <span>{{ __('admin.showing') }} {{ $hairDonations->firstItem() }} {{ __('admin.to') }} {{ $hairDonations->lastItem() }} {{ __('admin.of') }} {{ $hairDonations->total() }} {{ __('admin.results') }}</span>
                </div>
                <div class="pagination-wrapper">
                    <div class="pagination-links">
                        {{-- Previous Page Link --}}
                        @if ($hairDonations->onFirstPage())
                            <span class="pagination-btn nav-btn disabled">‹</span>
                        @else
                            <a href="{{ $hairDonations->previousPageUrl() }}" class="pagination-btn nav-btn">‹</a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $currentPage = $hairDonations->currentPage();
                            $lastPage = $hairDonations->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $hairDonations->url(1) }}" class="pagination-btn">1</a>
                            @if($start > 2)
                                <span class="pagination-dots">...</span>
                            @endif
                        @endif

                        @for($page = $start; $page <= $end; $page++)
                            @if ($page == $currentPage)
                                <span class="pagination-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $hairDonations->url($page) }}" class="pagination-btn">{{ $page }}</a>
                            @endif
                        @endfor

                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="pagination-dots">...</span>
                            @endif
                            <a href="{{ $hairDonations->url($lastPage) }}" class="pagination-btn">{{ $lastPage }}</a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($hairDonations->hasMorePages())
                            <a href="{{ $hairDonations->nextPageUrl() }}" class="pagination-btn nav-btn">›</a>
                        @else
                            <span class="pagination-btn nav-btn disabled">›</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Modal HTML untuk konfirmasi aksi --}}
<div id="actionConfirmModal" class="modal">
    <div class="modal-content delete-modal">
        <div class="modal-body text-center">
            <h3 id="confirmMessage"></h3>
        </div>

        <div class="modal-actions">
            <button type="button" class="btn-cancel" onclick="closeModal('actionConfirmModal')">{{ __('donation.cancel') }}</button>
            <button type="button" class="btn-confirm" onclick="executeAction()">{{ __('donation.ok') }}</button>
        </div>
    </div>
</div>

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Yantramanav:wght@300;400;500;600;700&display=swap');

    .hair-donations-management {
        padding: 0;
        background: white;
        font-family: 'Yantramanav';
        margin-left: -15px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        padding: 0 30px;
        padding-top: 20px;
        margin-left: 650px;
    }

    .search-container {
        position: relative;
        flex: 1;
        max-width: 300px;
    }

    .search-container input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 14px;
        background: white;
        font-family: 'Yantramanav', sans-serif;
    }

    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        object-fit: contain;
        cursor: pointer;
    }

    .id-th-small {
        font-size: 12px !important;
    }

    .alert {
        border-radius: 14px;
        opacity: 1;
        transition: opacity 2s ease-out;
        animation: fadeIn 0.5s ease;
        width: 98%;
        margin-left: 10px;
    }

    .alert.fade-out {
        opacity: 0;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .donations-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-right: -15px;
        border: 1px solid #e8e8e8;
        width: calc(100% - 15px);
    }

    .donations-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
    }

    .donations-table th {
        padding: 18px 15px;
        text-align: left;
        vertical-align: middle;
        background: #fafafa;
        font-weight: 600;
        color: #2c2c2c;
        font-size: 14px;
        font-family: 'Yantramanav';
        border-bottom: 2px solid #f0f0f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .donations-table th.text-right {
        text-align: right;
    }

    .donations-table td {
        padding: 15px 15px;
        text-align: left;
        vertical-align: middle;
        font-size: 15px;
        color: #2c2c2c;
        font-family: 'Yantramanav';
        background: white;
        border-bottom: 2px solid #e8e8e8;
    }

    .donations-table tbody tr {
        border-bottom: 2px solid #e8e8e8;
        position: relative;
    }

    .donations-table tbody tr:last-child td {
        border-bottom: 2px solid #e8e8e8;
    }

    .donations-table tbody tr:hover {
        background: #fafafa;
    }

    .donations-table tbody tr:hover td {
        background: #fafafa;
        border-bottom: 2px solid #e8e8e8;
    }

    .status-badge {
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        font-family: 'Yantramanav';
        border: 1px solid transparent;
        width: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        text-align: center;
    }

    .status-missing {
        background-color: #FFD3D3;
        color: #AC1A1A;
        border-color: #fce4e4;
    }

    .status-received {
        background-color: #C4F0B3;
        color: #328525;
        border-color: #d4edda;
    }

    .status-waiting {
        background-color: #FFDDA5;
        color: #EF8C00;
        border-color: #fff3cd;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: flex-start;
        align-items: center;
        flex-wrap: nowrap;
    }

    .action-btn {
        padding: 8px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        transition: all 0.3s ease;
        margin-right: 8px;
    }

    .action-btn img {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }

    .action-btn:disabled {
        cursor: default;
        transform: none;
        background-color: transparent;
    }

    .action-btn:disabled:hover {
        transform: none;
        background-color: transparent;
    }

    .approve-btn:hover {
        background: rgba(46, 125, 50, 0.1);
        border-radius: 50%;
    }

    .reject-btn:hover {
        background: rgba(211, 47, 47, 0.1);
        border-radius: 50%;
    }

    .delete-btn:hover {
        background: rgba(255, 0, 0, 0.1);
        border-radius: 50%;
    }

    .no-data {
        text-align: center;
        color: #999;
        font-style: italic;
        padding: 40px;
        font-size: 16px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #FEF0F0;
        margin: 3% auto;
        padding: 0;
        border-radius: 14px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        position: relative;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #FEF0F0;
    }

    .modal-header h3 {
        margin: 0;
        color: #333;
        font-family: 'Yantramanav';
        font-size: 1.4rem;
        font-weight: 600;
    }

    .close {
        width: 24px;
        height: 24px;
        object-fit: contain;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .close:hover {
        background: #f5f5f5;
        transform: scale(1.1);
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        background: #FEF0F0;
        border-radius: 0 0 15px 15px;
    }

    .btn-cancel,
    .btn-confirm {
        padding: 10px 10px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-size: 15px;
        font-family: 'Yantramanav';
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 120px;
    }

    .btn-cancel {
        background-color: #E8E8E8;
        font-weight: 500;
    }

    .btn-cancel:hover {
        background-color: #CCC;
        color: #FFFFFF;
    }

    .btn-confirm {
        background: #F9BCC4;
        color: #333;
        border: 1px solid #F9BCC4;
    }

    .btn-confirm:hover {
        background: #F791A9;
        border-color: #F791A9;
        color: white;
    }

    .delete-modal {
        text-align: center;
        margin: 50vh auto;
        transform: translateY(-50%);
    }

    .delete-modal .modal-body {
        padding: 30px 20px 0px 20px;
    }

    .delete-modal .modal-body h3 {
        margin: 0;
        color: black;
        font-family: 'Yantramanav';
        font-size: 1.2rem;
        font-weight: 500;
        line-height: 1.4;
    }

    .delete-modal .modal-actions {
        padding: 20px 20px 20px;
        border-top: none;
        gap: 15px;
        justify-content: center;
    }

    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-top: 1px solid #e8e8e8;
        background: white;
    }

    .pagination-info {
        font-size: 14px;
        color: #666;
        font-family: 'Yantramanav';
    }

    .pagination-wrapper {
        display: flex;
        align-items: center;
    }

    .pagination-links {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .pagination-btn {
        padding: 8px 12px;
        border: none;
        background: white;
        color: #333;
        text-decoration: none;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Yantramanav';
        font-weight: 500;
        min-width: 32px;
        height: 32px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ddd;
    }

    .pagination-btn:hover:not(.disabled):not(.active) {
        background: white;
        color: #333;
        text-decoration: none;
        border-color: #ccc;
    }

    .pagination-btn.active {
        background: #F791A9;
        color: white;
        font-weight: 600;
        border-color: #F791A9;
    }

    .pagination-btn.nav-btn {
        font-size: 16px;
        font-weight: 600;
        width: 32px;
        min-width: 32px;
        background: white;
        color: #333;
        border-color: #ddd;
    }

    .pagination-btn.nav-btn:hover:not(.disabled) {
        background: white;
        color: #333;
        border-color: #ccc;
    }

    .pagination-btn.disabled {
        background: #E8E8E8;
        color: #999;
        cursor: not-allowed;
        opacity: 0.6;
        border-color: #E8E8E8;
    }

    .pagination-dots {
        padding: 8px 4px;
        color: #666;
        font-size: 14px;
        font-family: 'Yantramanav';
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>
    // --- BAGIAN UTAMA UNTUK PENCARIAN CLIENT-SIDE ---
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('donationsTableBody');
        const allDataRows = tableBody.querySelectorAll('tr.donation-row');
        const noDataRow = document.getElementById('no-data-row');

        // Sembunyikan baris "no data" pada awalnya jika ada data
        if (allDataRows.length > 0 && noDataRow) {
            noDataRow.style.display = 'none';
        } else if (allDataRows.length === 0 && noDataRow) {
            // Tampilkan jika memang tidak ada data sama sekali dari server
            noDataRow.style.display = 'table-row';
        }

        searchInput.addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            let visibleRowCount = 0;

            allDataRows.forEach(row => {
                // Mengambil seluruh teks dari satu baris untuk pencarian
                const rowText = row.textContent.toLowerCase();
                const isVisible = rowText.includes(searchTerm);
                
                row.style.display = isVisible ? '' : 'none'; // Gunakan string kosong untuk kembali ke default display
                
                if (isVisible) {
                    visibleRowCount++;
                }
            });

            // Tampilkan atau sembunyikan pesan "tidak ada data" berdasarkan hasil filter
            if (noDataRow) {
                const noDataCell = noDataRow.querySelector('.no-data');
                if (visibleRowCount === 0) {
                    noDataRow.style.display = 'table-row';
                    // Ubah teks pesan jika pengguna sedang mengetik di search bar
                    if (searchTerm) {
                        noDataCell.textContent = "{{ __('donation.no_donations_found_for', ['search' => '']) }}" + `"${searchTerm}"`;
                    } else {
                        noDataCell.textContent = "{{ __('donation.no_donations_found') }}";
                    }
                } else {
                    noDataRow.style.display = 'none';
                }
            }
        });
    });

    // --- LOGIKA UNTUK MODAL DAN AKSI (TETAP SAMA) ---
    let donationIdToAction = null;
    let actionType = null;

    function showActionConfirmModal(message) {
        document.getElementById('confirmMessage').innerText = message;
        document.getElementById('actionConfirmModal').style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        if (modalId === 'actionConfirmModal') {
            donationIdToAction = null;
            actionType = null;
        }
    }

    function confirmAction(donationId, type) {
        donationIdToAction = donationId;
        actionType = type;
        let message = '';
        if (type === 'approve') {
            message = '{{ __('donation.confirm_approve') }}';
        } else if (type === 'reject') {
            message = '{{ __('donation.confirm_reject') }}';
        } else if (type === 'delete') {
            message = '{{ __('donation.confirm_delete') }}';
        }
        showActionConfirmModal(message);
    }

    function executeAction() {
        if (donationIdToAction && actionType) {
            const form = document.createElement('form');
            form.method = 'POST';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);

            if (actionType === 'delete') {
                form.action = '{{ route('admin.donations.destroy', ['hairDonation' => '__ID__']) }}'.replace('__ID__', donationIdToAction);
                methodInput.value = 'DELETE';
            } else if (actionType === 'approve') {
                form.action = '{{ route('admin.donations.approve', ['hairDonation' => '__ID__']) }}'.replace('__ID__', donationIdToAction);
                methodInput.value = 'PUT';
            } else if (actionType === 'reject') {
                form.action = '{{ route('admin.donations.reject', ['hairDonation' => '__ID__']) }}'.replace('__ID__', donationIdToAction);
                methodInput.value = 'PUT';
            }

            document.body.appendChild(form);
            form.submit();
        }
    }

    function deleteHairDonation(donationId) {
        confirmAction(donationId, 'delete');
    }

    window.onclick = function(event) {
        const modals = document.getElementsByClassName('modal');
        for (let i = 0; i < modals.length; i++) {
            if (event.target === modals[i]) {
                closeModal(modals[i].id);
            }
        }
    }

    // Auto-dismiss alerts
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');

        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('fade-out');
                setTimeout(() => successAlert.remove(), 500);
            }, 3000);
        }

        if (errorAlert) {
            setTimeout(() => {
                errorAlert.classList.add('fade-out');
                setTimeout(() => errorAlert.remove(), 500);
            }, 3000);
        }
    });
</script>
@endpush
@endsection