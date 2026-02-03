<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tasfia Tahsin Annita's Portfolio</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@900&display=swap');

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

        /* Floating Cyber Logo 'TASFIA TAHSIN ANNITA' */
        #hero-avatar {
            position: absolute;
            top: 35%;
            /* Moved up from 50% to avoid overlap with gates */
            left: 50%;
            transform: translate(-50%, -50%);
            width: auto;

            /* Logo Container Flex */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            opacity: 0.2;
            z-index: 1;
            pointer-events: none;
            animation: floatLogo 6s ease-in-out infinite;
        }

        #hero-avatar::before {
            content: 'TASFIA\A TAHSIN\A ANNITA';
            /* Stacked Name */
            white-space: pre;
            /* Enable line breaks */
            text-align: center;
            line-height: 1.1;

            /* Strict Local Font Stack */
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', sans-serif;
            font-size: 8rem;
            /* Reduced size for 3 lines */
            font-weight: 900;
            letter-spacing: 15px;
            text-transform: uppercase;

            /* Gradient Text Fill */
            background: linear-gradient(180deg, #fff 0%, #50fa7b 50%, #bd93f9 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;

            filter: drop-shadow(0 0 20px rgba(80, 250, 123, 0.5));
            -webkit-text-stroke: 2px rgba(255, 255, 255, 0.3);
        }

        /* Reflection Effect */
        #hero-avatar::after {
            content: 'TASFIA\A TAHSIN\A ANNITA';
            white-space: pre;
            text-align: center;
            line-height: 1.1;

            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', sans-serif;
            font-size: 8rem;
            font-weight: 900;
            letter-spacing: 15px;
            text-transform: uppercase;

            position: absolute;
            top: 85%;
            /* Moved down to account for height */
            left: 0;
            right: 0;
            /* Center horizontal */
            margin: auto;

            transform: scaleY(-0.5);
            opacity: 0.3;

            background: linear-gradient(180deg, transparent 40%, #50fa7b 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            filter: blur(4px);
        }

        @keyframes floatLogo {

            0%,
            100% {
                transform: translate(-50%, -50%);
            }

            50% {
                transform: translate(-50%, -55%);
            }
        }

        /* Removed rotation animation */
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
    <style>
        /* Icon Styling for SVGs */
        .gate svg {
            width: 30px;
            /* Smaller icons as requested */
            height: 30px;
            fill: none;
            stroke: var(--icon-stroke);
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.5));
            z-index: 2;
            transition: all 0.3s ease;
        }

        .gate:hover svg {
            transform: scale(1.2);
            stroke: var(--accent-color);
            filter: drop-shadow(0 0 10px var(--accent-color));
        }

        /* Stranger Things Theme Overrides */
        [data-theme="stranger"] body {
            /* The Upside Down Atmosphere */
            background: linear-gradient(to bottom, #09090b 0%, #1a0505 100%);
        }

        /* Ground: Veins of Vecna - improved */
        [data-theme="stranger"] #ground {
            background-image: url('<?= base_url("assets/veins.svg") ?>');
            background-size: 400px 100px;
            /* Stretch to match aspect ratio of SVG */
            background-color: #050000;
            border-top: none;
            /* Seamless blend */
            box-shadow: 0 -20px 60px rgba(0, 0, 0, 1);
            position: absolute;
            bottom: 0;
            left: 0;
            opacity: 1;
            /* Blend mode to make it look embedded */
            mix-blend-mode: normal;
        }

        /* Remove the broken 'slime' top layer */
        [data-theme="stranger"] #ground::after {
            display: none;
        }

        /* Portals: Authentic Organic Rifts */
        /* Based on the reference: amorphous, dark, red-glowing mass */
        [data-theme="stranger"] .gate>div:first-child {
            width: 100px;
            /* Wider base */
            height: 140px;
            border: none;

            /* Amorphous biological shape */
            border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;

            /* Deep dark red core */
            background: radial-gradient(circle at 40% 40%, #ff4d4d 0%, #300 40%, #000 90%);

            /* Heavy Atmosphere Glow */
            box-shadow:
                0 0 30px rgba(255, 0, 0, 0.4),
                0 0 10px rgba(255, 0, 0, 0.6) inset;

            /* Living animation */
            animation: amorphousPulse 6s ease-in-out infinite alternate;
        }

        [data-theme="stranger"] .gate:hover>div:first-child {
            background: radial-gradient(ellipse at center, #fff 0%, #ff4d4d 40%, #800000 80%);
            box-shadow: 0 0 60px #ff0000, 0 0 100px #ff0000;
            transform: scale(1.05);
        }

        /* Bright Red Labels for Stranger Theme */
        [data-theme="stranger"] .gate-label {
            color: #ff0000;
            text-shadow: 0 0 5px #ff0000;
            font-weight: bold;
            letter-spacing: 2px;
        }

        /* --- Stranger Things Modal Theme --- */
        [data-theme="stranger"] .modal-content {
            background: linear-gradient(180deg, #1a0000 0%, #000 100%);
            border: 2px solid #500;
            box-shadow: 0 0 30px #800000, inset 0 0 50px #000;
            color: #ffcccc;
        }

        [data-theme="stranger"] .modal-header {
            color: #ff0000;
            text-shadow: 0 0 10px #ff0000;
            border-bottom: 1px solid #500;
            padding-bottom: 15px;
        }

        [data-theme="stranger"] .btn-exit {
            background: #300;
            border: 1px solid #ff0000;
            color: #ff0000;
            box-shadow: 0 0 10px #500;
            transition: all 0.3s;
        }

        [data-theme="stranger"] .btn-exit:hover {
            background: #ff0000;
            color: #000;
            box-shadow: 0 0 20px #ff0000;
        }

        [data-theme="stranger"] .project-card {
            background: rgba(40, 0, 0, 0.6);
            border-left: 3px solid #ff0000;
        }

        [data-theme="stranger"] a {
            color: #ff4d4d;
        }

        @keyframes amorphousPulse {
            0% {
                border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            }

            33% {
                border-radius: 40% 60% 34% 66% / 45% 68% 32% 55%;
            }

            66% {
                border-radius: 73% 27% 64% 36% / 65% 38% 62% 35%;
            }

            100% {
                border-radius: 53% 47% 44% 56% / 45% 58% 42% 55%;
            }
        }

        /* Decor: Floating Ash / Spores */
        [data-theme="stranger"] #decor-bg {
            background-image:
                radial-gradient(white 1px, transparent 1px),
                radial-gradient(rgba(255, 255, 255, 0.8) 1px, transparent 1px);
            background-size: 50px 50px, 100px 100px;
            background-position: 0 0, 20px 20px;
            animation: ashFall 15s linear infinite;
            opacity: 0.6;
            mix-blend-mode: overlay;
        }

        @keyframes breathe {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Decor: Floating Ash / Spores */
        [data-theme="stranger"] #decor-bg {
            background-image:
                radial-gradient(white 1px, transparent 1px),
                radial-gradient(rgba(255, 255, 255, 0.8) 1px, transparent 1px);
            background-size: 50px 50px, 100px 100px;
            background-position: 0 0, 20px 20px;
            animation: ashFall 15s linear infinite;
            opacity: 0.6;
            mix-blend-mode: overlay;
        }

        @keyframes ashFall {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateY(200px) rotate(20deg);
                opacity: 0;
            }
        }

        /* CSS Variables for Theming */
        :root {
            /* Cyberpunk (Default) */
            --bg-color: #0c0c16;
            --text-color: #e0e0ff;
            --primary-color: #50fa7b;
            /* Neon Green */
            --secondary-color: #bd93f9;
            /* Purple */
            --accent-color: #ff79c6;
            /* Pink */
            --portal-gradient: radial-gradient(circle at 50% 50%, #000 20%, #2d1b4e 60%, #4c1d95 100%);
            --portal-border: rgba(189, 147, 249, 0.6);
            --font-logo: 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', sans-serif;
            --logo-gradient: linear-gradient(180deg, #fff 0%, #50fa7b 50%, #bd93f9 100%);
            --ground-border: 4px solid #50fa7b;
            --ground-shadow: 0 -5px 15px rgba(80, 250, 123, 0.4);
            --icon-stroke: #ffffff;
            --logo-stroke: #50fa7b;
        }

        /* Stranger Things Theme */
        [data-theme="stranger"] {
            --bg-color: #050000;
            --text-color: #ffcccc;
            --primary-color: #ff0000;
            /* Red */
            --secondary-color: #800000;
            /* Dark Red */
            --accent-color: #ff0000;
            --portal-gradient: radial-gradient(circle at 50% 50%, #000 20%, #4a0000 60%, #800000 100%);
            --portal-border: rgba(255, 0, 0, 0.6);
            --font-logo: 'Georgia', 'Times New Roman', serif;
            /* Serif for Stranger Things look */
            --logo-gradient: linear-gradient(180deg, #ff0000 0%, #000 100%);
            /* Solid Red-ish with stroke */
            --ground-border: 4px solid #ff0000;
            --ground-shadow: 0 -5px 25px rgba(255, 0, 0, 0.6);
            --icon-stroke: #ff9999;
            --logo-stroke: #ff0000;
        }

        /* Apply Variables */
        body {
            background: var(--bg-color);
            color: var(--text-color);
            transition: background 0.5s ease, color 0.5s ease;
        }

        /* Theme Toggle Button */
        #theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 10px 20px;
            cursor: pointer;
            font-family: inherit;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        #theme-toggle:hover {
            background: var(--primary-color);
            color: #000;
            box-shadow: 0 0 15px var(--primary-color);
        }

        /* Update Logo to use Variables */
        #hero-avatar::before,
        #hero-avatar::after {
            font-family: var(--font-logo);
            /* Handle gradient slightly differently for ST theme via variables */
            background: var(--logo-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-stroke: 2px var(--logo-stroke);
            filter: drop-shadow(0 0 20px var(--primary-color));
        }

        /* If Stranger Theme: Dark Fill with Bright Red Border */
        [data-theme="stranger"] #hero-avatar::before,
        [data-theme="stranger"] #hero-avatar::after {
            background: none;
            color: #2a0000;
            /* Dark Blood Fill */
            -webkit-text-stroke: 3px #ff0000;
            /* Bright Red Border */
            text-shadow:
                0 0 10px rgba(255, 0, 0, 0.5),
                0 0 30px rgba(255, 0, 0, 0.3);
            opacity: 1;
        }

        /* Stranger Things Theme Overrides */
        [data-theme="stranger"] body {
            /* The Upside Down Atmosphere */
            background: linear-gradient(to bottom, #09090b 0%, #1a0505 100%);
        }

        /* Ground: Veins of Vecna - improved */
        [data-theme="stranger"] #ground {
            background-image: url('<?= base_url("assets/veins.svg") ?>');
            background-size: 400px 200px;
            /* Wider stretch to match reference scale */
            background-color: transparent;
            /* Deep black base */
            border-top: none;
            /* Red glow coming appearing from the fog */
            box-shadow:
                inset 0 0 50px #000,
                0 -10px 30px rgba(255, 0, 0, 0.6);
            position: absolute;
            bottom: 0;
            left: 0;
            opacity: 1;
            transform-origin: bottom;
            transform: scaleY(1.0);
        }

        /* Remove the broken 'slime' top layer */
        [data-theme="stranger"] #ground::after {
            display: none;
        }

        /* Portals: Authentic Organic Rifts */
        /* ... existing styles ... */
        .gate>div:first-child {
            background: var(--portal-gradient);
            border: 4px solid var(--portal-border);
            box-shadow: 0 0 15px var(--secondary-color), 0 0 30px var(--secondary-color) inset;
        }

        .gate svg {
            stroke: var(--icon-stroke);
        }

        .gate:hover svg {
            transform: scale(1.1);
            stroke: var(--accent-color);
            /* Pink neon stroke on hover */
            filter: drop-shadow(0 0 10px var(--accent-color));
        }

        .gate:hover>div:first-child,
        .gate.active>div:first-child {
            border-color: var(--accent-color);
            box-shadow: 0 0 30px var(--accent-color), 0 0 50px var(--secondary-color) inset;
        }

        /* Update Ground */
        #ground {
            border-top: var(--ground-border);
            box-shadow: var(--ground-shadow);
        }

        /* Particle override for stranger theme to look like ash? */
        [data-theme="stranger"] #decor-bg {
            background:
                radial-gradient(circle, rgba(255, 0, 0, 0.2) 2px, transparent 2px),
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 100px 100px, 200px 200px;
            animation: ashFall 20s linear infinite;
        }

        @keyframes ashFall {
            from {
                background-position: 0 0, 0 0;
            }

            to {
                background-position: 0 500px, 100px 500px;
            }
        }

        /* Mobile Responsiveness & Touch Controls */
        #touch-controls {
            display: none;
            /* Hidden on desktop */
            position: fixed;
            bottom: 20px;
            left: 0;
            width: 100%;
            padding: 0 20px;
            justify-content: space-between;
            pointer-events: none;
            /* Let touches pass through container */
            z-index: 1000;
        }

        .control-group {
            display: flex;
            gap: 15px;
            pointer-events: auto;
        }

        .control-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.4);
            color: white;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
            touch-action: manipulation;
            user-select: none;
            -webkit-user-select: none;
        }

        .control-btn:active {
            background: rgba(80, 250, 123, 0.4);
            transform: scale(0.95);
        }

        .control-btn.jump-btn {
            width: 70px;
            height: 70px;
            background: rgba(189, 147, 249, 0.3);
            border-color: rgba(189, 147, 249, 0.6);
        }

        @media (max-width: 768px) {
            #touch-controls {
                display: flex;
            }

            #hero-avatar::before,
            #hero-avatar::after {
                font-size: 3rem;
                /* Smaller logo */
                letter-spacing: 5px;
            }

            #hero-avatar {
                width: 100%;
                top: 25%;
                /* Move up a bit */
            }

            #instruction {
                font-size: 0.8rem;
                width: 90%;
                top: 80px;
            }

            /* Adjust modal size */
            .modal-content {
                width: 95%;
                margin: 20px auto;
                padding: 1rem;
            }

            /* Stranger things mobile overrides */
            [data-theme="stranger"] #hero-avatar::before {
                -webkit-text-stroke: 1px #ff0000;
            }
        }
    </style>
</head>

<body>

    <div id="world-container">
        <button id="theme-toggle" onclick="toggleTheme()">SWITCH REALM</button>
        <div id="parallax-bg"></div>
        <div id="decor-bg"></div>
        <div id="hero-avatar"></div>

        <div id="game-world">
            <div id="ground"></div>
            <div id="avatar"></div>

            <!-- GATES -->
            <div class="gate" data-modal="about" style="left: 500px;">
                <div>
                    <!-- User Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="gate-label">ABOUT ME</div>
            </div>

            <div class="gate" data-modal="education" style="left: 850px;">
                <div>
                    <!-- Book / Education Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <div class="gate-label">EDUCATION</div>
            </div>

            <div class="gate" data-modal="experience" style="left: 1200px;">
                <div>
                    <!-- Briefcase Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
                <div class="gate-label">EXPERIENCE</div>
            </div>

            <div class="gate" data-modal="projects" style="left: 1550px;">
                <div>
                    <!-- Code / Terminal Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                    </svg>
                </div>
                <div class="gate-label">PROJECTS</div>
            </div>

            <div class="gate" data-modal="publications" style="left: 1900px;">
                <div>
                    <!-- File Text Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div class="gate-label">PUBLICATIONS</div>
            </div>

            <div class="gate" data-modal="contact" style="left: 2250px;">
                <div>
                    <!-- Mail Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div class="gate-label">CONTACT</div>
            </div>
        </div>
        <div id="instruction">Use ← → to walk | SPACE/↑ to jump | 'E' or ENTER to enter gate</div>

        <!-- Touch Controls for Mobile -->
        <div id="touch-controls">
            <div class="control-group">
                <div id="btn-left" class="control-btn">←</div>
                <div id="btn-right" class="control-btn">→</div>
            </div>
            <div class="control-group">
                <div id="btn-action" class="control-btn jump-btn">↑</div>
            </div>
        </div>
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

                if (e.key === 'Enter' || e.key === 'e' || e.key === 'E') {
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

            // Touch Controls Support
            const btnLeft = document.getElementById('btn-left');
            const btnRight = document.getElementById('btn-right');
            const btnAction = document.getElementById('btn-action');

            if (btnLeft && btnRight && btnAction) {
                const addTouch = (el, code) => {
                    const press = (e) => {
                        // Prevent default to stop scrolling/zooming/mouse emulation
                        if (e.cancelable) e.preventDefault();

                        // Handle Jump/Enter specific logic
                        if (code === 'Space') {
                            // Check for interaction (Enter) first
                            let interacted = false;
                            gates.forEach(gate => {
                                const gateLeft = parseInt(gate.style.left, 10);
                                if (Math.abs(avatarX - gateLeft) < 80 && avatarY <= 100) {
                                    openModal(gate.dataset.modal);
                                    interacted = true;
                                }
                            });

                            if (!interacted) {
                                // Just Jump
                                keys['Space'] = true;
                            }
                        } else {
                            keys[code] = true;
                        }
                    };
                    const release = (e) => {
                        if (e.cancelable) e.preventDefault();
                        keys[code] = false;
                    };

                    el.addEventListener('touchstart', press, {
                        passive: false
                    });
                    el.addEventListener('touchend', release, {
                        passive: false
                    });
                    el.addEventListener('mousedown', press);
                    el.addEventListener('mouseup', release);
                    el.addEventListener('mouseleave', release);
                };

                addTouch(btnLeft, 'ArrowLeft');
                addTouch(btnRight, 'ArrowRight');
                addTouch(btnAction, 'Space');
            }

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

    <script>
        function toggleTheme() {
            const body = document.body;
            const currentTheme = body.getAttribute('data-theme');

            if (currentTheme === 'stranger') {
                body.setAttribute('data-theme', 'cyber');
            } else {
                body.setAttribute('data-theme', 'stranger');
            }
        }
    </script>
</body>

</html>