<x-store-layout title="Our Story - SushiYup Zen Edition">
@push('styles')
    @vite('resources/css/service.css')
@endpush

    <div class="story-page">
        <!-- Hero -->
        <section class="story-hero">
            <span>The Art of Authenticity</span>
            <h1>Modern Asian<br>Soul</h1>
            <p>
                Founded on the principles of purity and precision, SushiYup is more than a restaurant—it is a sanctuary dedicated to the thousand-year-old tradition of Edomae-style sushi, redefined for the contemporary urban lifestyle.
            </p>
        </section>

        <!-- Our Origins -->
        <section class="story-section">
            <div class="origins-split" style="direction: rtl;">
                <div class="origins-content" style="direction: ltr;">
                    <h2>Our Origins</h2>
                    <p>
                        SushiYup began with a simple dream: to bring the purity of authentic Japanese flavor to the heart of the modern urban hustle. Inspired by Zen philosophy, we believe that in simplicity lies a perfection that is truly timeless.
                    </p>
                    <p>
                        Our journey started with a search for the finest ingredients from every corner of the morning fish market. From perfectly polished Shari rice grains to premium Salmon from the coldest waters, every element at SushiYup has its own story. We don't just serve food; we share a cultural heritage crafted by dedicated culinary artisans.
                    </p>
                </div>
                <div class="origins-img">
                    <img src="{{ asset('images/v5/our-origins.png') }}" alt="Sushi Preparation">
                </div>
            </div>
        </section>

        <!-- Artisanal Way -->
        <section class="story-section" style="background: #fafafa;">
            <div class="origins-split">
                <div class="origins-content">
                    <h2>The Artisanal Way</h2>
                    <p>
                        Precision is our primary language. At SushiYup, every cut of fish is performed with surgical meticulousness to ensure the perfect distribution of fat and texture in every single bite. Our rice is seasoned with traditional red vinegar that has undergone an aging process, providing a deep umami aroma and a unique, distinguished color.
                    </p>
                    <p>
                        We practice the art of "Omotenashi"—heartfelt Japanese hospitality. From our open kitchen, you can personally witness how our chefs transform raw ingredients into visual masterpieces, creating a seamless dance between the knife, the fish, and the rice.
                    </p>
                </div>
                <div class="origins-img">
                    <img src="{{ asset('images/v5/artisanal-way.png') }}" alt="Sushi Platter">
                </div>
            </div>
        </section>

        <!-- Philosophy -->
        <section class="philosophy-stripe">
            <h2>Our Core Philosophy</h2>
            <div class="philosophy-grid">
                <div class="phi-item">
                    <h4>Purity of Flavor</h4>
                    <p>We let the natural freshness of our ingredients speak for themselves without overwhelming seasonings.</p>
                </div>
                <div class="phi-item">
                    <h4>Honest Sourcing</h4>
                    <p>Only wild and exceptionally fresh fish from the finest morning markets enter our kitchen daily.</p>
                </div>
                <div class="phi-item">
                    <h4>Zen Atmosphere</h4>
                    <p>Our dining space is designed as an escape from the city noise, providing sanctuary for your senses.</p>
                </div>
            </div>
        </section>

        <!-- Quality Details -->
        <section class="services-detail">
            <div class="detail-header">
                <h2>Our Dining Services</h2>
            </div>
            <div class="detail-grid">
                <div class="detail-card">
                    <h3>Dine-In Omakase</h3>
                    <p>The most exclusive dining experience at our sushi bar. Leave it entirely to our chef to select the finest seasonal fish just for you.</p>
                </div>
                <div class="detail-card">
                    <h3>Select Menu Dine-In</h3>
                    <p>Enjoy the Zen atmosphere at our private tables while selecting your favorite dishes directly from our professionally curated full menu.</p>
                </div>
                <div class="detail-card">
                    <h3>Artisanal Takeaway</h3>
                    <p>The art of sushi remains preserved even when enjoyed at home. Our takeaway service uses custom packaging to maintain temperature and aesthetics.</p>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="story-cta">
            <h2 style="font-family: 'Cinzel', serif; font-size: 2.5rem; margin-bottom: 2rem;">Ready to Begin Your Journey?</h2>
            <p style="color: #666; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">Join us and experience firsthand our unwavering dedication to the art of Japanese culinary mastery.</p>
            <div class="cta-buttons-wrapper">
                <a href="{{ route('items') }}" class="v4-btn-primary">Discover Menu</a>
                <a href="https://wa.me/" class="v4-btn-primary reservation-btn">RESERVATION</a>
            </div>
        </section>
    </div>
</x-store-layout>
