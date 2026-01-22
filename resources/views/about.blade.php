<x-store-layout title="About Us - Sushi Ecommerce">
    <style>
        .about-page {
            background: #111;
            color: white;
        }

        /* Hero Section */
        .about-hero {
            position: relative;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('/images/about-hero.jpg') center/cover no-repeat;
            opacity: 0.4;
            transform: scale(1.1);
        }

        .about-hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            padding: 0 5%;
        }

        .about-hero h1 {
            font-family: 'Cinzel', serif;
            font-size: 4rem;
            margin-bottom: 1rem;
            letter-spacing: 4px;
        }

        .about-hero p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            font-style: italic;
        }

        /* Story Section */
        .story-section {
            padding: 8rem 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6rem;
            align-items: center;
        }

        .story-image {
            position: relative;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .story-image img {
            width: 100%;
            display: block;
            transition: transform 0.8s;
        }

        .story-image:hover img {
            transform: scale(1.05);
        }

        .story-content h2 {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            color: var(--vibrant-orange);
            margin-bottom: 2rem;
        }

        .story-content p {
            font-size: 1.1rem;
            line-height: 1.9;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1.5rem;
        }

        /* Philosophy & Values */
        .philosophy-section {
            background: #1a1a1a;
            padding: 8rem 5%;
        }

        .philosophy-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .philosophy-header h2 {
            font-family: 'Cinzel', serif;
            font-size: 3rem;
            margin-bottom: 4rem;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3rem;
        }

        .value-card {
            padding: 3rem 2rem;
            background: #111;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.3s;
        }

        .value-card:hover {
            transform: translateY(-10px);
            border-color: var(--vibrant-orange);
        }

        .value-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .value-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--vibrant-orange);
        }

        .value-card p {
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
        }

        /* Chef Section */
        .chef-section {
            padding: 8rem 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .chef-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 5rem;
            align-items: center;
        }

        .chef-image {
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .chef-image img {
            width: 100%;
            display: block;
        }

        .chef-content h2 {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .chef-title {
            color: var(--vibrant-orange);
            font-weight: 500;
            margin-bottom: 2rem;
            display: block;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @media (max-width: 768px) {
            .story-grid, .chef-grid, .values-grid {
                grid-template-columns: 1fr;
            }
            .about-hero h1 {
                font-size: 2.8rem;
            }
        }
    </style>

    <div class="about-page">
        <!-- Hero Section -->
        <section class="about-hero">
            <div class="about-hero-content">
                <h1 class="font-cinzel">Tradition in Every Grain</h1>
                <p>Membawa cita rasa otentik Jepang ke jantung kota sejak 1998.</p>
            </div>
        </section>

        <!-- Story Section -->
        <section class="story-section">
            <div class="story-grid">
                <div class="story-image">
                    <img src="/images/about-story.jpg" alt="Our History">
                </div>
                <div class="story-content">
                    <h2>Our Journey</h2>
                    <p>
                        Berawal dari sebuah kedai kecil berkapasitas 6 orang di pinggiran distrik Tsukiji, Tokyo, Sushi Store didirikan oleh Chef Tanaka dengan satu mimpi sederhana: menyajikan ikan terbaik dengan teknik tradisional yang jujur.
                    </p>
                    <p>
                        Selama lebih dari dua dekade, kami telah berevolusi dari usaha keluarga yang sederhana menjadi destinasi kuliner ikonik. Meskipun kami tumbuh, filosofi kami tidak pernah berubah. Setiap potongan ikan dipilih langsung setiap fajar, menjamin kesegaran yang tidak tertandingi.
                    </p>
                    <p>
                        Di setiap butir nasi yang kami siapkan, terkandung dedikasi untuk menjaga warisan kuliner Jepang agar tetap relevan di zaman modern tanpa kehilangan jiwanya.
                    </p>
                </div>
            </div>
        </section>

        <!-- Philosophy Section -->
        <section class="philosophy-section">
            <div class="philosophy-container">
                <div class="philosophy-header">
                    <h2>Our Philosophy</h2>
                </div>
                <div class="values-grid">
                    <div class="value-card">
                        <span class="value-icon">🐟</span>
                        <h3>Bahan Tanpa Kompromi</h3>
                        <p>Hanya ikan dengan kualitas 'Grade A' yang boleh masuk ke dapur kami. Hubungan kami yang erat dengan nelayan lokal menjamin bahan baku terbaik.</p>
                    </div>
                    <div class="value-card">
                        <span class="value-icon">🧑‍🍳</span>
                        <h3>Ketangkasan Seni</h3>
                        <p>Membuat sushi bukan hanya tentang memotong ikan, tapi tentang keseimbangan rasa, suhu nasi, dan tekanan tangan sang Master.</p>
                    </div>
                    <div class="value-card">
                        <span class="value-icon">🤝</span>
                        <h3>Omotenashi</h3>
                        <p>Semangat keramahtamahan Jepang yang tulus. Kami melayani setiap tamu seperti tamu terhormat di rumah kami sendiri.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Chef Section -->
        <section class="chef-section">
            <div class="chef-grid">
                <div class="chef-content">
                    <h2>Master Chef Kenji Tanaka</h2>
                    <span class="chef-title">Pendiri & Head Chef</span>
                    <p>
                        Dengan pengalaman lebih dari 30 tahun melatih ketajaman pisaunya, Chef Kenji telah mengabdi pada seni Edomae-style sushi. Baginya, sushi yang sempurna adalah harmoni antara alam dan teknik manusia.
                    </p>
                    <p>
                        "Nasi adalah jiwa dari sushi. Ikan adalah keelokannya. Tanpa jiwa yang baik, keelokan itu tidak akan berarti apa-apa," tutur Chef Kenji tentang pendekatannya yang legendaris.
                    </p>
                </div>
                <div class="chef-image">
                    <img src="/images/chef.jpg" alt="Master Chef Kenji Tanaka">
                </div>
            </div>
        </section>
    </div>
</x-store-layout>
