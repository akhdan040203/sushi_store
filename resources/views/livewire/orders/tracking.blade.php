<div class="tracking-page" wire:poll.3s>
    <style>
        .tracking-page {
            background: #111;
            min-height: 100vh;
            padding: 4rem 5% 6rem;
            color: white;
        }

        .tracking-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .tracking-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .tracking-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            color: #FF7A00;
            margin-bottom: 0.5rem;
        }

        /* Progress Bar / Stepper */
        .stepper {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 4rem;
            padding: 0 20px;
        }

        .stepper::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 50px;
            right: 50px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .step-progress {
            position: absolute;
            top: 25px;
            left: 50px;
            height: 4px;
            background: linear-gradient(to right, #FF7A00, #FF9F43);
            z-index: 2;
            transition: width 1s ease-in-out;
        }

        .step {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100px;
        }

        .step-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #1a1a1a;
            border: 4px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: all 0.5s;
            color: rgba(255, 255, 255, 0.3);
        }

        .step.active .step-icon {
            border-color: #FF7A00;
            background: #FF7A00;
            color: white;
            box-shadow: 0 0 20px rgba(255, 122, 0, 0.4);
        }

        .step.completed .step-icon {
            border-color: #22C55E;
            background: #22C55E;
            color: white;
        }

        .step-label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
            text-align: center;
        }

        .step.active .step-label, .step.completed .step-label {
            color: white;
        }

        /* Order Details Card */
        .order-status-card {
            background: #1a1a1a;
            border-radius: 24px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
        }

        .status-hero {
            margin-bottom: 2.5rem;
        }

        .status-main {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }

        .status-desc {
            color: rgba(255, 255, 255, 0.5);
            font-size: 1rem;
        }

        .pulse-animation {
            width: 12px;
            height: 12px;
            background: #FF7A00;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 0 rgba(255, 122, 0, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 122, 0, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(255, 122, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 122, 0, 0); }
        }

        .summary-mini {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .summary-item {
            text-align: left;
        }

        .summary-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.25rem;
        }

        .summary-value {
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-back {
            display: inline-block;
            margin-top: 3rem;
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .btn-back:hover {
            color: #FF7A00;
        }
    </style>

    <div class="tracking-container">
        <div class="tracking-header">
            <p style="color: rgba(255,255,255,0.5); margin-bottom: 0.5rem;">ORDER TRACKING</p>
            <h1>#{{ $order->order_number }}</h1>
        </div>

        @php
            $statuses = ['pending', 'processing', 'shipped', 'delivered'];
            $currentIndex = array_search($order->status, $statuses);
            $progressWidth = ($currentIndex / (count($statuses) - 1)) * 100;
        @endphp

        <div class="stepper">
            <div class="step-progress" style="width: {{ $progressWidth }}%;"></div>
            
            <div class="step {{ $currentIndex >= 0 ? ($currentIndex > 0 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="step-label">Placed</div>
            </div>

            <div class="step {{ $currentIndex >= 1 ? ($currentIndex > 1 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="step-label">Preparing</div>
            </div>

            <div class="step {{ $currentIndex >= 2 ? ($currentIndex > 2 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="step-label">Ready</div>
            </div>

            <div class="step {{ $currentIndex >= 3 ? ($currentIndex > 3 ? 'completed' : 'active') : '' }}">
                <div class="step-icon">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="step-label">Arrived</div>
            </div>
        </div>

        <div class="order-status-card">
            <div class="status-hero">
                @if($order->status != 'delivered' && $order->status != 'cancelled')
                    <div class="pulse-animation"></div>
                @endif
                <div class="status-main">
                    @if($order->status == 'pending')
                        Menunggu Konfirmasi
                    @elseif($order->status == 'processing')
                        Sushimu Sedang Dibuat
                    @elseif($order->status == 'shipped')
                        Pesanan Siap Diantar!
                    @elseif($order->status == 'delivered')
                        Selamat Menikmati!
                    @elseif($order->status == 'cancelled')
                        Pesanan Dibatalkan
                    @endif
                </div>
                <div class="status-desc">
                    @if($order->status == 'pending')
                        Kami sedang mengecek pesananmu segera.
                    @elseif($order->status == 'processing')
                        Chef kami sedang meramu bahan-bahan segar untukmu.
                    @elseif($order->status == 'shipped')
                        Siapkan meja Anda, sushi favoritmu segera sampai.
                    @elseif($order->status == 'delivered')
                        Terima kasih telah memesan di Sushi Ecommerce.
                    @elseif($order->status == 'cancelled')
                        Maaf, pesanan ini tidak dapat dilanjutkan.
                    @endif
                </div>
            </div>

            <div class="summary-mini">
                <div class="summary-item">
                    <div class="summary-label">Estimasi Selesai</div>
                    <div class="summary-value" style="color: #FF7A00;">
                        @if($order->status == 'processing')
                            ~15-20 Menit
                        @elseif($order->status == 'shipped')
                            Lagi Di Jalan
                        @elseif($order->status == 'delivered')
                            Selesai
                        @else
                            Menunggu...
                        @endif
                    </div>
                </div>
                <div class="summary-item" style="text-align: right;">
                    <div class="summary-label">Total Pembayaran</div>
                    <div class="summary-value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Tipe Pesanan</div>
                    <div class="summary-value">{{ ucfirst(str_replace('_', ' ', $order->order_type)) }}</div>
                </div>
                <div class="summary-item" style="text-align: right;">
                    <div class="summary-label">Nomor Meja</div>
                    <div class="summary-value">{{ $order->table_number ?? 'Takeaway' }}</div>
                </div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('orders.history') }}" class="btn-back">
                &larr; Kembali ke Riwayat Pesanan
            </a>
        </div>
    </div>
</div>
