@extends('admin.layout.app')

@section('title', 'Requested Wig')

@section('content')

<div class="details-page">
    <div class="page-header">
        <h1 class="page-title">Request Details</h1>
        <a href="{{ route('admin.request_admin') }}" class="back-button">&#8249 Back to All Requests</a>
    </div>

    <div class="details-container">
        <!-- User's Details Card -->
        <div class="detail-card">
            <h2 class="card-title">User's Details</h2>
            <div class="card-grid">
                <div class="detail-item">
                    <span class="item-label">User ID</span>
                    <span class="item-value">{{ $hairRequest->user_id ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Recipient's Details Card -->
        <div class="detail-card">
            <h2 class="card-title">Recipient's Details</h2>
            <div class="card-content">
                <div class="column">
                    <div class="detail-item">
                        <span class="item-label">Full Name</span>
                        <span class="item-value">{{ $hairRequest->recipient_full_name }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="item-label">Age</span>
                        <span class="item-value">{{ $hairRequest->recipient_age }}</span>
                    </div>
                </div>
                <div class="column">
                    <div class="detail-item">
                        <span class="item-label">Email</span>
                        <span class="item-value">{{ $hairRequest->recipient_email ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="item-label">Phone Number</span>
                        <span class="item-value">{{ $hairRequest->recipient_phone ?? '-' }}</span>
                    </div>
                </div>
                <div class="column">
                    <div class="detail-item full-width">
                        <span class="item-label">Reason for Hair Loss</span>
                        <span class="item-value">{{ $hairRequest->recipient_reason }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- requester's detail card condition  -->
        @if($hairRequest->who_for !== 'myself')
            <div class="detail-card">
                <h2 class="card-title">Requester's Details</h2>
                <div class="card-content">
                     <!-- show healtcare location only for health_professional -->
                        @if($hairRequest->who_for === 'health_professional')
                         <div class="column">
                            <div class="detail-item">
                                <span class="item-label">Full Name</span>
                                <span class="item-value">{{ $hairRequest->requester_full_name }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="item-label">Email</span>
                                <span class="item-value">{{ $hairRequest->requester_email }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="item-label">Phone Number</span>
                                <span class="item-value">{{ $hairRequest->requester_phone }}</span>
                            </div>
                        </div>
                        <div class="column">
                            <div class="detail-item">
                                <span class="item-label">Healthcare Location</span>
                                <span class="item-value">{{ $hairRequest->healthcare_location }}</span>
                            </div>
                        </div>
                        @endif
                   
                        
                        
                        <!-- show relationship to recipeint for parent_guardian -->
                        @if($hairRequest->who_for === 'parent_guardian')
                        <div class="column">
                            <div class="detail-item">
                                <span class="item-label">Full Name</span>
                                <span class="item-value">{{ $hairRequest->requester_full_name }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="item-label">Relationship to Recipient</span>
                                <span class="item-value">{{ $hairRequest->relationship_to_recipient }}</span>
                            </div>
                        </div>
                        <div class="column">
                            <div class="detail-item">
                                <span class="item-label">Email</span>
                                <span class="item-value">{{ $hairRequest->requester_email }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="item-label">Phone Number</span>
                                <span class="item-value">{{ $hairRequest->requester_phone }}</span>
                            </div>
                        </div>
                        
                        @endif
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .details-page {
        padding: 20px;
        background-color: #fafafa;
        font-family: 'Yantramanav', sans-serif;
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

    .detail-card:has(.card-title:contains("Recipient's Details")) .column:nth-child(3) {
        grid-column: span 2;
    }

    .detail-card:has(.card-title:contains("Recipient's Details")) .card-content {
        grid-template-columns: 1fr 1fr 2fr;
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