<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tasfia Tahsin Annita's Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
                radial-gradient(circle, rgba(255, 255, 255, 0.4) 1px, transparent 1px),
                radial-gradient(circle, rgba(80, 250, 123, 0.3) 1px, transparent 1px),
                radial-gradient(circle, rgba(255, 85, 85, 0.3) 1px, transparent 1px);
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

            0%,
            100% {
                transform: translate(-50%, 0);
            }

            50% {
                transform: translate(-50%, -20px);
            }
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
            background-image: url('<?= base_url("assets/ground-texture.png") ?>');
            background-repeat: repeat-x;
            background-size: auto 100%;
            /* Scale to height, repeat horizontal */
            background-position: top left;
            border-top: 4px solid #50fa7b;
            /* Neon green top edge */
            box-shadow: 0 -5px 15px rgba(80, 250, 123, 0.4);
            image-rendering: pixelated;
            z-index: 2;
        }

        #avatar {
            position: absolute;
            bottom: 100px;
            left: 200px;
            /* The sprite sheet has 3 columns and 2 rows based on the image provided earlier */
            /* We want to show a single frame first. The frame size seems to be roughly square */
            /* Let's guess the frame size. If the image is 300x200 (approx), one frame is 100x100 */
            width: 100px;
            height: 100px;
            /* Background Image is set via JS for transparency processing */
            /* Default fallback or placeholder */
            /* background-image: url('<?= base_url("assets/hero-sprites.png") ?>'); */

            /* Background Image is set via JS for transparency processing */

            background-size: 300% 100%;
            background-position: 0 0;

            width: 140px;
            /* Increased size */
            height: 140px;
            bottom: 75px;
            /* Lowered to touch the ground (Ground is 100px high) */

            image-rendering: pixelated;
            z-index: 10;
            will-change: bottom, left;
            font-size: 0;
            color: transparent;

            filter: drop-shadow(0 0 2px #50fa7b);
        }

        /* Walking Animation */
        /* 3 Frames: 0% (Left), 50% (Center), 100% (Right) */
        @keyframes walk {
            0% {
                background-position: 0% 0;
            }

            33% {
                background-position: 50% 0;
            }

            66% {
                background-position: 100% 0;
            }

            100% {
                background-position: 0% 0;
            }

            /* Loop back */
        }

        #avatar.walking {
            /* 0.5s duration, strict steps to avoid sliding between frames */
            animation: walk 0.6s step-end infinite;
        }

        @keyframes heroIdle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-3px);
            }
        }

        #instruction {
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.5);
            padding: 6px 18px;
            border-radius: 16px;
            color: #6272a4;
            font-size: 1rem;
            z-index: 20;
            pointer-events: none;
        }

        /* Portals of a Different Realm */
        @keyframes portalPulse {
            0% {
                box-shadow: 0 0 15px #bd93f9, 0 0 30px #6272a4 inset;
            }

            50% {
                box-shadow: 0 0 30px #ff79c6, 0 0 50px #bd93f9 inset;
            }

            100% {
                box-shadow: 0 0 15px #bd93f9, 0 0 30px #6272a4 inset;
            }
        }

        @keyframes portalSpin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .gate {
            position: absolute;
            bottom: 110px;
            width: 120px;
            height: 160px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            /* Align portal to bottom */
            cursor: pointer;
            z-index: 5;
        }

        /* The Portal Visual (The first child div which contains the icon) */
        .gate>div:first-child {
            position: relative;
            width: 100px;
            /* Narrower width */
            height: 140px;
            /* Taller height */
            /* Oval shape */
            border-radius: 50%;
            background: radial-gradient(circle at 50% 50%, #000 20%, #2d1b4e 60%, #4c1d95 100%);
            border: 4px solid rgba(189, 147, 249, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 0 15px #bd93f9, 0 0 30px #6272a4 inset;
            transition: transform 0.3s, border-color 0.3s, box-shadow 0.3s;
            z-index: 10;
        }

        /* The swirling vortex inside the portal visual */
        .gate>div:first-child::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200%;
            height: 200%;
            background: repeating-conic-gradient(from 0deg,
                    transparent 0deg,
                    rgba(139, 233, 253, 0.1) 15deg,
                    rgba(255, 121, 198, 0.1) 30deg,
                    transparent 45deg);
            animation: portalSpin 12s linear infinite;
            z-index: -1;
            /* Behind the icon */
            pointer-events: none;
        }

        /* The Icon Text itself need to be on top of the vortex */
        .gate>div:first-child>div {
            font-size: 2rem;
            /* Slightly smaller icon */
            color: #fff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 2;
            /* Ensure icon is above vortex */
        }

        .gate:hover>div:first-child,
        .gate.active>div:first-child {
            transform: scale(1.1);
            border-color: #ff79c6;
            box-shadow: 0 0 30px #ff79c6, 0 0 50px #bd93f9 inset;
        }

        .gate-label {
            position: absolute;
            top: 0;
            /* At the top of the container */
            width: 100%;
            color: #50fa7b;
            font-weight: 800;
            text-align: center;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 2px 4px #000;
            margin-bottom: 10px;
            z-index: 20;
            pointer-events: none;
        }

        /* Animation for Floating Icon is applied to the content of the div, 
           but since the div contains text directly, we can't animate the text node easily 
           without wrapping it. 
           However, the previous code animated the div itself which was wrong for the vortex container.
           We can just leave the icon static or animate the font-size/scale slightly?
           Or we can't easily animate the text node inside the overflow:hidden container 
           without affecting the vortex if we apply unique transforms.
           Let's just adding a subtle pulse to the icon via text-shadow or scale.
        */


        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 100;
            padding: 2rem;
            overflow-y: auto;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

        .project-card ul {
            margin-left: 1.2rem;
            margin-top: 0.5rem;
        }

        .project-card li {
            margin: 0.3rem 0;
        }

        a {
            color: #50fa7b;
            text-decoration: none;
        }

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

        #form-response.success {
            background: #287a46;
            color: white;
        }

        #form-response.error {
            background: #a53a3a;
            color: white;
        }
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
            <div class="gate" data-modal="about" style="left: 500px;">
                <div>
                    <div>🚪</div>
                </div>
                <div class="gate-label">ABOUT ME</div>
            </div>

            <div class="gate" data-modal="education" style="left: 850px;">
                <div>
                    <div>🎓</div>
                </div>
                <div class="gate-label">EDUCATION</div>
            </div>

            <div class="gate" data-modal="experience" style="left: 1200px;">
                <div>
                    <div>💼</div>
                </div>
                <div class="gate-label">EXPERIENCE</div>
            </div>

            <div class="gate" data-modal="projects" style="left: 1550px;">
                <div>
                    <div>🧪</div>
                </div>
                <div class="gate-label">PROJECTS</div>
            </div>

            <div class="gate" data-modal="publications" style="left: 1900px;">
                <div>
                    <div>📚</div>
                </div>
                <div class="gate-label">PUBLICATIONS</div>
            </div>

            <div class="gate" data-modal="contact" style="left: 2250px;">
                <div>
                    <div>📧</div>
                </div>
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

    <div id="modal-education" class="modal">
        <div class="modal-content">
            <h2 class="modal-header">ARCHIVE // EDUCATION</h2>
            <div class="modal-body">
                <?= $zones['education'] ?>
            </div>
            <div class="modal-footer">
                <button class="btn-exit" onclick="closeModal('education')">EXIT TO WORLD</button>
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
            let avatarY = 50; // Lowered further to 50 (Ground is 100). Overlap = 50px.
            const worldWidth = 2800;
            const containerWidth = window.innerWidth;

            let isJumping = false;
            let jumpVelocity = 0;
            const gravity = 0.9;
            const jumpPower = -18;

            // Process the sprite sheet to remove black background
            const spriteImg = new Image();
            spriteImg.src = '<?= base_url("assets/hero-sprites.png") ?>';
            spriteImg.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = spriteImg.width;
                canvas.height = spriteImg.height;
                ctx.drawImage(spriteImg, 0, 0);

                // Get image data
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const data = imageData.data;

                // Loop through pixels and make black transparent
                // Threshold for "black" (e.g., RGB < 10)
                for (let i = 0; i < data.length; i += 4) {
                    const r = data[i];
                    const g = data[i + 1];
                    const b = data[i + 2];
                    if (r < 20 && g < 20 && b < 20) {
                        data[i + 3] = 0; // Set Alpha to 0
                    }
                }

                ctx.putImageData(imageData, 0, 0);

                // Set the processed image as the avatar background
                avatar.style.backgroundImage = `url(${canvas.toDataURL()})`;
                // Reset mix-blend-mode since we have real transparency now
                avatar.style.mixBlendMode = 'normal';
            };

            setTimeout(() => {
                if (instruction) instruction.style.opacity = '0';
            }, 3500);

            function updateWorld() {
                const cameraX = avatarX - containerWidth / 2;
                const clamped = Math.max(0, Math.min(cameraX, worldWidth - containerWidth));
                gameWorld.style.transform = `translateX(-${clamped}px)`;
                avatar.style.left = avatarX + 'px';
                avatar.style.bottom = avatarY + 'px';

                gates.forEach(gate => gate.classList.remove('active'));
                gates.forEach(gate => {
                    const gateLeft = parseInt(gate.style.left, 10);
                    // Adjusted Y check since base is now 75
                    if (Math.abs(avatarX - gateLeft) < 80 && avatarY <= 100) {
                        gate.classList.add('active');
                    }
                });
            }

            // Input State
            const keys = {
                ArrowRight: false,
                ArrowLeft: false,
                Space: false,
                ArrowUp: false
            };

            document.addEventListener('keydown', (e) => {
                if (keys.hasOwnProperty(e.code) || e.key === " " || e.key === "ArrowUp" || e.key === "ArrowLeft" || e.key === "ArrowRight") {
                    // Map space to Space if needed, though usually e.code is Space
                    const key = e.key === " " ? "Space" : e.key;
                    keys[key] = true;
                }

                if (e.key === 'Enter') {
                    gates.forEach(gate => {
                        const gateLeft = parseInt(gate.style.left, 10);
                        if (Math.abs(avatarX - gateLeft) < 80 && avatarY <= 100) {
                            openModal(gate.dataset.modal);
                        }
                    });
                    e.preventDefault();
                }
            });

            document.addEventListener('keyup', (e) => {
                const key = e.key === " " ? "Space" : e.key;
                if (keys.hasOwnProperty(key)) {
                    keys[key] = false;
                }
                // Also handle the raw key names just in case
                keys[e.key] = false;
            });

            const moveSpeed = 6; // Slower speed (was ~25 per event)

            function gameLoop() {
                // Horizontal Movement
                let moving = false;
                if (keys.ArrowRight) {
                    avatarX = Math.min(avatarX + moveSpeed, worldWidth - 50);
                    avatar.style.transform = 'scaleX(1)';
                    moving = true;
                }
                if (keys.ArrowLeft) {
                    avatarX = Math.max(avatarX - moveSpeed, 50);
                    avatar.style.transform = 'scaleX(-1)';
                    moving = true;
                }

                // Toggle walking animation
                if (moving) {
                    avatar.classList.add('walking');
                } else {
                    avatar.classList.remove('walking');
                }

                // Jumping
                if ((keys.Space || keys.ArrowUp) && !isJumping) {
                    isJumping = true;
                    jumpVelocity = jumpPower;
                }

                // Physics
                if (isJumping) {
                    jumpVelocity += gravity;
                    avatarY -= jumpVelocity;

                    // Floor Collision - Match init value (50)
                    if (avatarY <= 50) {
                        avatarY = 50;
                        isJumping = false;
                        jumpVelocity = 0;
                    }
                }

                updateWorld();
                requestAnimationFrame(gameLoop);
            }

            // Start the loop
            gameLoop();

            const form = document.getElementById('contact-form');
            if (form) {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const formData = new FormData(form);
                    const resDiv = document.getElementById('form-response');
                    try {
                        const res = await fetch(window.BASE_URL + 'portfolio/send_message', {
                            method: 'POST',
                            body: formData
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