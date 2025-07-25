<section class="static-page contact-page">
    <h2>Kontak Kami</h2>

    <p class="subtitle">Jika Anda memiliki pertanyaan, saran, atau membutuhkan bantuan, tim kami siap membantu Anda.</p>
    
    <div class="contact-container">
        <div class="contact-info soft-ui-card">
            <h3><i class="fas fa-info-circle"></i> Informasi Kontak</h3>
            <ul>
                <li>
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div class="contact-detail">
                        <strong>Email</strong>
                        <span>babajustore@email.com</span>
                    </div>
                </li>
                <li>
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="contact-detail">
                        <strong>Telepon</strong>
                        <span>+62 812-3456-7890</span>
                    </div>
                </li>
                <li>
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-detail">
                        <strong>Alamat</strong>
                        <span>Jl. Umban Sari No. 9, Rumbai, Riau, Indonesia</span>
                    </div>
                </li>
            </ul>
            
        

<style>
    :root {
        --primary: #974b2fff;        
        --primary-light: #5a1b0eff;  
        --secondary: #F4A261;      
        --accent: #e4aa74ff;        
        --text: #a66a46ff;          
        --text-light: #221610ff;    
        --white: #ffffffff;
        --shadow: 0 5px 15px rgba(45, 93, 124, 0.1);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* Modern Base Styles */
    .static-page.contact-page {
        max-width: 1000px;
        margin: 0 auto;
        padding: 4rem 2rem;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        color: var(--text);
    }

    .static-page.contact-page h2 {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 1.5rem;
        text-align: center;
        letter-spacing: -0.5px;
    }

    .subtitle {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 700px;
        margin: 0 auto 4rem;
        line-height: 1.6;
        text-align: center;
        font-weight: 400;
    }

    /* Grid Layout */
    .contact-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2.5rem;
        align-items: start;
    }

    /* Minimalist Card Design */
    .contact-info {
        background: var(--white);
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: var(--shadow);
        border: 1px solid rgba(45, 93, 124, 0.1);
        transition: var(--transition);
    }

    .contact-info:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(45, 93, 124, 0.15);
        border-color: rgba(45, 93, 124, 0.2);
    }

    .contact-info h3 {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .contact-info h3:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--secondary);
        border-radius: 3px;
    }

    /* Clean List Style */
    .contact-info ul {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem 0;
    }

    .contact-info ul li {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        padding: 1.25rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .contact-info ul li:last-child {
        border-bottom: none;
    }

    /* Modern Icon Style */
    .contact-icon {
        width: 44px;
        height: 44px;
        background: var(--accent);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        flex-shrink: 0;
        font-size: 1.1rem;
        transition: var(--transition);
    }

    .contact-info ul li:hover .contact-icon {
        background: var(--primary);
        color: var(--white);
        transform: rotate(5deg);
    }

    /* Typography Focus */
    .contact-detail strong {
        display: block;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.25rem;
        font-size: 1.05rem;
    }

    .contact-detail span {
        color: var(--text-light);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Social Media Buttons */
    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
    }

    .social-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        transition: var(--transition);
        font-size: 1.1rem;
    }

    .social-icon:hover {
        transform: translateY(-3px);
    }


    /* Optional Map Container */
    .map-container {
        height: 300px;
        background: var(--accent);
        border-radius: 12px;
        margin-top: 3rem;
        overflow: hidden;
        border: 1px solid rgba(45, 93, 124, 0.1);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .static-page.contact-page {
            padding: 3rem 1.5rem;
        }
        
        .static-page.contact-page h2 {
            font-size: 2.2rem;
        }
        
        .contact-container {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
    }

    @media (max-width: 480px) {
        .static-page.contact-page {
            padding: 2rem 1rem;
        }
        
        .contact-info {
            padding: 1.75rem;
        }
        
        .contact-info h3 {
            font-size: 1.3rem;
        }
    }
</style>