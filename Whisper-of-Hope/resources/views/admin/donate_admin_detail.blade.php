@extends('admin.layout.app')

@section('title', __('donation.page_title_details'))

@section('content')

<div class="details-page">
    <div class="page-header">
        <h1 class="page-title">{{ __('donation.donator_details_page_title') }}</h1>
        <a href="{{ route('admin.donate_admin') }}" class="back-button">&#8249; {{ __('donation.back_to_donations') }}</a>
    </div>

    <div class="details-container">
        <div class="detail-card">
            <h2 class="card-title">{{ __('donation.user_details_card_title') }}</h2>
            <div class="card-grid">
                <div class="detail-item">
                    <span class="item-label">{{ __('donation.user_id') }}</span>
                    <span class="item-value">{{ $hairDonation->user_id ?? __('donation.na') }}</span>
                </div>
                <div class="detail-item">
                    <span class="item-label">{{ __('donation.full_name') }}</span>
                    <span class="item-value">{{ $hairDonation->user->name ?? $hairDonation->full_name ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="item-label">{{ __('donation.gender') }}</span>
                    <span class="item-value">{{ $hairDonation->user->gender ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="item-label">{{ __('donation.email') }}</span>
                    <span class="item-value">{{ $hairDonation->user->email ?? $hairDonation->email ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="item-label">{{ __('donation.phone_number') }}</span>
                    <span class="item-value">{{ $hairDonation->user->phone ?? $hairDonation->phone ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <h2 class="card-title">{{ __('donation.donator_details_card_title') }}</h2>
            <div class="card-content">
                <div class="column">
                    <div class="detail-item">
                        <span class="item-label">{{ __('donation.full_name') }}</span>
                        <span class="item-value">{{ $hairDonation->full_name }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="item-label">{{ __('donation.donation_id') }}</span>
                        <span class="item-value">{{ $hairDonation->id ?? '-' }}</span>
                    </div>
                </div>
                <div class="column">
                    <div class="detail-item">
                        <span class="item-label">{{ __('donation.email') }}</span>
                        <span class="item-value">{{ $hairDonation->email ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="item-label">{{ __('donation.phone_number') }}</span>
                        <span class="item-value">{{ $hairDonation->phone ?? '-' }}</span>
                    </div>
                </div>
                <div class="column">
                    <div class="detail-item">
                        <span class="item-label">{{ __('donation.age') }}</span>
                        <span class="item-value">{{ $hairDonation->age ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="item-label">{{ __('donation.hair_length') }}</span>
                        <span class="item-value">{{ $hairDonation->hair_length ?? '-' }} {{ __('donation.cm') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.details-page {
    padding: 20px;
    background-color: #fafafa;
    font-family: 'Yantramanav', sans-serif;
    margin-top: 40px;
    border-radius: 12px;
}
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e0e0e0;
}
.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #333;
    margin: 0;
}
.back-button {
    color: #8c8c8c;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}
.back-button:hover {
    color: #000;
}
.details-container {
    display: flex;
    flex-direction: column;
    gap: 25px;
}
.detail-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    padding: 25px;
}
.card-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin: 0 0 25px 0;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}
.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}
.card-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 30px;
    row-gap: 25px;
}
.column {
    display: flex;
    flex-direction: column;
    gap: 25px;
}
.detail-item {
    display: flex;
    flex-direction: column;
}
.item-label {
    font-size: 14px;
    color: #8c8c8c;
    margin-bottom: 5px;
}
.item-value {
    font-size: 16px;
    color: #333;
    font-weight: 500;
    line-height: 1.5;
}
.detail-item.full-width {
    grid-column: 1 / -1;
}
</style>
@endsection
