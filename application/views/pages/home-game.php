<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tasfia Tahsin Annita's Portfolio</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #0c0c16;
            overflow: hidden;
            height: 100vh;
            font-family: 'Courier New', monospace;
            color: #e0e0ff;
        }

        #world-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        /* Deep background */
        #parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 2800px;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(80, 250, 123, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255, 85, 85, 0.05) 0%, transparent 20%),
                linear-gradient(to bottom, #0f0f23 0%, #0a0a14 100%);
            z-index: -1;
        }

        /* Decorative mid-layer */
        #decor-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle, rgba(255,255,255,0.4) 1px, transparent 1px),
                radial-gradient(circle, rgba(80,250,123,0.3) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,85,85,0.3) 1px, transparent 1px);
            background-size: 120px 120px, 180px 180px, 220px 220px;
            background-position: 0 0, 60px 60px, 100px 100px;
            z-index: 0;
            pointer-events: none;
            opacity: 0.5;
        }

        /* Welcome Title */
        #welcome-title {
            position: absolute;
            top: 120px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2.6rem;
            color: #50fa7b;
            text-align: center;
            text-shadow: 0 0 15px rgba(80, 250, 123, 0.8);
            z-index: 20;
            margin: 0;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }

        /* Floating Hero Avatar */
        #hero-avatar {
            position: absolute;
            top: 28%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 130px;
            opacity: 0.12;
            z-index: 10;
            pointer-events: none;
            animation: float 6s infinite ease-in-out;
        }
        @keyframes float {
            0%, 100% { transform: translate(-50%, 0); }
            50% { transform: translate(-50%, -20px); }
        }

        #game-world {
            position: absolute;
            top: 0;
            left: 0;
            width: 2800px;
            height: 100%;
            transition: transform 0.3s linear;
            z-index: 15;
        }

        #ground {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: #1a1b26;
            border-top: 2px solid #44475a;
            z-index: 2;
        }

        #avatar {
            position: absolute;
            bottom: 100px;
            left: 200px;
            font-size: 42px;
            z-index: 10;
            text-shadow: 0 0 10px #ff5555;
            will-change: bottom, left;
        }

        #instruction {
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.5);
            padding: 6px 18px;
            border-radius: 16px;
            color: #6272a4;
            font-size: 1rem;
            z-index: 20;
            pointer-events: none;
        }

        .gate {
            position: absolute;
            bottom: 120px;
            width: 120px;
            height: 180px;
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            border: 2px solid #ff5555;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            cursor: pointer;
            z-index: 5;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .gate:hover, .gate.active {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(76, 175, 80, 0.8);
        }
        .gate-label {
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 0.9rem;
            line-height: 1.2;
            margin-top: 10px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.95);
            z-index: 100;
            padding: 2rem;
            overflow-y: auto;
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal-content {
            max-width: 800px;
            margin: 0 auto;
            background: #1a1b26;
            padding: 2rem;
            border: 1px solid #44475a;
            border-radius: 8px;
            color: #f8f8f2;
        }
        .modal-header {
            color: #50fa7b;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            text-align: center;
        }
        .modal-body {
            line-height: 1.6;
        }
        .modal-footer {
            margin-top: 2rem;
            text-align: center;
        }
        .btn-exit {
            background: #ff5555;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            cursor: pointer;
            font-family: inherit;
            border-radius: 4px;
            font-size: 1.1rem;
        }
        .btn-exit:hover {
            background: #d32f2f;
        }

        .project-card {
            background: #282a36;
            padding: 1.2rem;
            margin: 1rem 0;
            border-left: 3px solid #50fa7b;
            line-height: 1.5;
        }
        .project-card ul { margin-left: 1.2rem; margin-top: 0.5rem; }
        .project-card li { margin: 0.3rem 0; }
        a { color: #50fa7b; text-decoration: none; }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            background: #1e1f29;
            border: 1px solid #444;
            color: #f8f8f2;
        }
        .contact-form button {
            background: #ff5555;
            color: white;
            border: none;
            padding: 8px;
            width: 100%;
            margin-top: 8px;
            cursor: pointer;
        }
        #form-response {
            margin-top: 8px;
            padding: 6px;
            border-radius: 4px;
            font-size: 0.95rem;
        }
        #form-response.success { background: #287a46; color: white; }
        #form-response.error { background: #a53a3a; color: white; }
    </style>
</head>
<body>

<div id="world-container">
    <div id="parallax-bg"></div>
    <div id="decor-bg"></div>
    <h1 id="welcome-title">Welcome to Tasfia Tahsin Annita's Portfolio</h1>
    <div id="hero-avatar">🧑‍💻</div>
    
    <div id="game-world">
        <div id="ground"></div>
        <div id="avatar">🧑‍💻</div>
        
        <!-- GATES -->
        <div class="gate" data-modal="about" style="left: 600px;">
            <div>🚪</div>
            <div class="gate-label">ABOUT ME</div>
        </div>

        <div class="gate" data-modal="experience" style="left: 1000px;">
            <div>💼</div>
            <div class="gate-label">EXPERIENCE</div>
        </div>

        <div class="gate" data-modal="projects" style="left: 1400px;">
            <div>🧪</div>
            <div class="gate-label">PROJECTS</div>
        </div>

        <div class="gate" data-modal="publications" style="left: 1800px;">
            <div>📚</div>
            <div class="gate-label">PUBLICATIONS</div>
        </div>

        <div class="gate" data-modal="contact" style="left: 2200px;">
            <div>📧</div>
            <div class="gate-label">CONTACT</div>
        </div>
    </div>
    <div id="instruction">Use ← → to walk | SPACE/↑ to jump | ENTER near gate to enter</div>
</div>

<!-- MODALS -->
<div id="modal-about" class="modal">
    <div class="modal-content">
        <h2 class="modal-header">PROFILE // TASFIA</h2>
        <div class="modal-body">
            <?= $zones['about'] ?>
        </div>
        <div class="modal-footer">
            <button class="btn-exit" onclick="closeModal('about')">EXIT TO WORLD</button>
        </div>
    </div>
</div>

<div id="modal-experience" class="modal">
    <div class="modal-content">
        <h2 class="modal-header">LOG // WORK EXPERIENCE</h2>
        <div class="modal-body">
            <?= $zones['experience'] ?>
        </div>
        <div class="modal-footer">
            <button class="btn-exit" onclick="closeModal('experience')">EXIT TO WORLD</button>
        </div>
    </div>
</div>

<div id="modal-projects" class="modal">
    <div class="modal-content">
        <h2 class="modal-header">LAB // PROJECTS</h2>
        <div class="modal-body">
            <?= $zones['my_projects'] ?>
        </div>
        <div class="modal-footer">
            <button class="btn-exit" onclick="closeModal('projects')">EXIT TO WORLD</button>
        </div>
    </div>
</div>

<div id="modal-publications" class="modal">
    <div class="modal-content">
        <h2 class="modal-header">ARCHIVE // PUBLICATIONS</h2>
        <div class="modal-body">
            <?= $zones['publications'] ?>
        </div>
        <div class="modal-footer">
            <button class="btn-exit" onclick="closeModal('publications')">EXIT TO WORLD</button>
        </div>
    </div>
</div>

<div id="modal-contact" class="modal">
    <div class="modal-content">
        <h2 class="modal-header">COMMS // CONTACT</h2>
        <div class="modal-body">
            <?= $zones['contact'] ?>
        </div>
        <div class="modal-footer">
            <button class="btn-exit" onclick="closeModal('contact')">EXIT TO WORLD</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const gameWorld = document.getElementById('game-world');
    const avatar = document.getElementById('avatar');
    const instruction = document.getElementById('instruction');
    const gates = document.querySelectorAll('.gate');
    
    let avatarX = 200;
    let avatarY = 100;
    const worldWidth = 2800;
    const containerWidth = window.innerWidth;
    
    let isJumping = false;
    let jumpVelocity = 0;
    const gravity = 0.9;
    const jumpPower = -18;
    
    setTimeout(() => { if (instruction) instruction.style.opacity = '0'; }, 3500);

    function updateWorld() {
        const cameraX = avatarX - containerWidth / 2;
        const clamped = Math.max(0, Math.min(cameraX, worldWidth - containerWidth));
        gameWorld.style.transform = `translateX(-${clamped}px)`;
        avatar.style.left = avatarX + 'px';
        avatar.style.bottom = avatarY + 'px';
        
        gates.forEach(gate => gate.classList.remove('active'));
        gates.forEach(gate => {
            const gateLeft = parseInt(gate.style.left, 10);
            if (Math.abs(avatarX - gateLeft) < 80 && avatarY <= 120) {
                gate.classList.add('active');
            }
        });
    }

    function applyGravity() {
        if (isJumping) {
            jumpVelocity += gravity;
            avatarY -= jumpVelocity;

            if (avatarY <= 100) {
                avatarY = 100;
                isJumping = false;
                jumpVelocity = 0;
            }
            updateWorld();
            if (isJumping) {
                requestAnimationFrame(applyGravity);
            }
        }
    }

    function jump() {
        if (!isJumping) {
            isJumping = true;
            jumpVelocity = jumpPower;
            applyGravity();
        }
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') {
            avatarX = Math.min(avatarX + 25, worldWidth - 50);
            updateWorld();
            e.preventDefault();
        } else if (e.key === 'ArrowLeft') {
            avatarX = Math.max(avatarX - 25, 50);
            updateWorld();
            e.preventDefault();
        } else if (e.key === ' ' || e.key === 'ArrowUp') {
            jump();
            e.preventDefault();
        } else if (e.key === 'Enter') {
            gates.forEach(gate => {
                const gateLeft = parseInt(gate.style.left, 10);
                if (Math.abs(avatarX - gateLeft) < 80 && avatarY <= 120) {
                    openModal(gate.dataset.modal);
                    e.preventDefault();
                }
            });
        }
    });

    updateWorld();

    const form = document.getElementById('contact-form');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const resDiv = document.getElementById('form-response');
            try {
                const res = await fetch(window.BASE_URL + 'portfolio/send_message', {
                    method: 'POST', body: formData
                });
                const r = await res.json();
                resDiv.className = r.status;
                resDiv.textContent = r.msg || Object.values(r.errors).join('; ');
                if (r.status === 'success') form.reset();
            } catch (err) {
                resDiv.className = 'error';
                resDiv.textContent = 'Transmission failed.';
            }
        });
    }
});

function openModal(id) {
    document.getElementById(`modal-${id}`).style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(`modal-${id}`).style.display = 'none';
    document.body.style.overflow = 'auto';
}
</script>

</body>
</html>