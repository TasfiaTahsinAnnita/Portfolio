"use client";
import { useEffect, useRef, useState } from 'react';
import About from './content/About';
import Education from './content/Education';
import Experience from './content/Experience';
import Projects from './content/Projects';
import Publications from './content/Publications';
import Contact from './content/Contact';

export default function GameWorld() {
  const [activeModal, setActiveModal] = useState(null);
  
  // Refs for DOM elements
  const avatarRef = useRef(null);
  const gameWorldRef = useRef(null);
  const instructionRef = useRef(null);
  const requestRef = useRef(null);
  const gatesRef = useRef([]);

  // Mutable Game State (No Re-renders)
  const state = useRef({
    x: 200,
    y: 50,
    vx: 0,
    vy: 0,
    isJumping: false,
    keys: {
      ArrowRight: false,
      ArrowLeft: false,
      Space: false,
      ArrowUp: false
    }
  });

  // Constants
  const GRAVITY = 0.9;
  const JUMP_POWER = -18;
  const MOVE_SPEED = 6;
  const WORLD_WIDTH = 2800;

  useEffect(() => {
    // Canvas Sprite Processing
    const processSprite = () => {
      const spriteImg = new Image();
      spriteImg.src = '/assets/hero-sprites.png';
      spriteImg.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = spriteImg.width;
        canvas.height = spriteImg.height;
        ctx.drawImage(spriteImg, 0, 0);
        
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;
        
        for (let i = 0; i < data.length; i += 4) {
          const r = data[i];
          const g = data[i + 1];
          const b = data[i + 2];
          if (r < 20 && g < 20 && b < 20) {
            data[i + 3] = 0;
          }
        }
        
        ctx.putImageData(imageData, 0, 0);
        if (avatarRef.current) {
            avatarRef.current.style.backgroundImage = `url(${canvas.toDataURL()})`;
            avatarRef.current.style.mixBlendMode = 'normal';
        }
      };
    };
    processSprite();

    // Input Listeners
    const handleKeyDown = (e) => {
      const key = e.key === " " ? "Space" : e.key;
      if (state.current.keys.hasOwnProperty(key)) {
        state.current.keys[key] = true;
      }
      
      // Interaction
      if (e.key === 'Enter' || e.key === 'e' || e.key === 'E') {
        checkGates(true);
        e.preventDefault();
      }
    };

    const handleKeyUp = (e) => {
      const key = e.key === " " ? "Space" : e.key;
      if (state.current.keys.hasOwnProperty(key)) {
        state.current.keys[key] = false;
      }
    };

    window.addEventListener('keydown', handleKeyDown);
    window.addEventListener('keyup', handleKeyUp);

    // Game Loop
    const gameLoop = () => {
      const s = state.current;
      const avatar = avatarRef.current;
      const world = gameWorldRef.current;
      
      if (!avatar || !world) return;

      // Movement
      let moving = false;
      if (s.keys.ArrowRight) {
        s.x = Math.min(s.x + MOVE_SPEED, WORLD_WIDTH - 50);
        avatar.style.transform = 'scaleX(1)';
        moving = true;
      }
      if (s.keys.ArrowLeft) {
        s.x = Math.max(s.x - MOVE_SPEED, 50);
        avatar.style.transform = 'scaleX(-1)';
        moving = true;
      }

      if (moving) {
        avatar.classList.add('walking');
      } else {
        avatar.classList.remove('walking');
      }

      // Jump
      if ((s.keys.Space || s.keys.ArrowUp) && !s.isJumping) {
        s.isJumping = true;
        s.vy = JUMP_POWER;
      }

      // Physics
      if (s.isJumping) {
        s.vy += GRAVITY;
        s.y -= s.vy;
        if (s.y <= 50) {
          s.y = 50;
          s.isJumping = false;
          s.vy = 0;
        }
      }

      // Render X/Y
      avatar.style.left = `${s.x}px`;
      avatar.style.bottom = `${s.y}px`;

      // Camera
      const containerWidth = window.innerWidth;
      const cameraX = s.x - containerWidth / 2;
      const clamped = Math.max(0, Math.min(cameraX, WORLD_WIDTH - containerWidth));
      world.style.transform = `translateX(-${clamped}px)`;

      // Gates Highlight
      checkGates(false);

      requestRef.current = requestAnimationFrame(gameLoop);
    };

    const checkGates = (open) => {
      const s = state.current;
      gatesRef.current.forEach(gate => {
         if (!gate) return;
         const gateLeft = parseInt(gate.style.left, 10);
         // 80px range
         if (Math.abs(s.x - gateLeft) < 80 && s.y <= 100) {
             if (open) {
                 setActiveModal(gate.dataset.modal);
             } else {
                 gate.classList.add('active');
             }
         } else {
             if (!open) gate.classList.remove('active');
         }
      });
    };

    requestRef.current = requestAnimationFrame(gameLoop);

    // Cleanup
    return () => {
      window.removeEventListener('keydown', handleKeyDown);
      window.removeEventListener('keyup', handleKeyUp);
      cancelAnimationFrame(requestRef.current);
    };
  }, []); // Run once

  // Helper for Gates Ref
  const addToGatesRef = (el) => {
      if (el && !gatesRef.current.includes(el)) {
          gatesRef.current.push(el);
      }
  };

  const closeModal = () => {
    setActiveModal(null);
  };
  
  const toggleTheme = () => {
      const body = document.body;
      const current = body.getAttribute('data-theme');
      body.setAttribute('data-theme', current === 'stranger' ? 'cyber' : 'stranger');
  };
    
  // Touch
  const handleTouchStart = (key) => (e) => {
      e.preventDefault();
      const s = state.current;
      if (key === 'Space') {
          // Check interaction first hackily by triggering Enter event logic or just calling checkGates(true)
          let interacted = false;
          // We can't easily return value from checkGates, so copy logic
           const gates = document.querySelectorAll('.gate'); // or use ref
           // Actually let's just set Space key
           s.keys['Space'] = true;
           
           // Also try to open
           gatesRef.current.forEach(gate => {
             const gateLeft = parseInt(gate.style.left, 10);
             if (Math.abs(s.x - gateLeft) < 80 && s.y <= 100) {
                 setActiveModal(gate.dataset.modal);
                 s.keys['Space'] = false; // Don't jump if entering
             }
           });
      } else {
         s.keys[key] = true;
      }
  };
  
  const handleTouchEnd = (key) => (e) => {
      e.preventDefault();
      state.current.keys[key] = false;
  };

  return (
    <>
        <button id="theme-toggle" onClick={toggleTheme}>SWITCH REALM</button>
        <div id="parallax-bg"></div>
        <div id="decor-bg"></div>
        <div id="hero-avatar"></div>

        <div id="game-world" ref={gameWorldRef}>
            <div id="ground"></div>
            <div id="avatar" ref={avatarRef}></div>

            {/* GATES */}
            <div className="gate" data-modal="about" style={{left: '500px'}} ref={addToGatesRef} onClick={() => setActiveModal('about')}>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div className="gate-label">ABOUT ME</div>
            </div>

            <div className="gate" data-modal="education" style={{left: '850px'}} ref={addToGatesRef} onClick={() => setActiveModal('education')}>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <div className="gate-label">EDUCATION</div>
            </div>

            <div className="gate" data-modal="experience" style={{left: '1200px'}} ref={addToGatesRef} onClick={() => setActiveModal('experience')}>
                <div>
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
                <div className="gate-label">EXPERIENCE</div>
            </div>

            <div className="gate" data-modal="projects" style={{left: '1550px'}} ref={addToGatesRef} onClick={() => setActiveModal('projects')}>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                    </svg>
                </div>
                <div className="gate-label">PROJECTS</div>
            </div>

            <div className="gate" data-modal="publications" style={{left: '1900px'}} ref={addToGatesRef} onClick={() => setActiveModal('publications')}>
                <div>
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div className="gate-label">PUBLICATIONS</div>
            </div>

            <div className="gate" data-modal="contact" style={{left: '2250px'}} ref={addToGatesRef} onClick={() => setActiveModal('contact')}>
                <div>
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div className="gate-label">CONTACT</div>
            </div>
        </div>
        
        <div id="instruction" ref={instructionRef}>Use ← → to walk | SPACE/↑ to jump | 'E' or ENTER to enter gate</div>

        <div id="touch-controls">
            <div className="control-group">
                <div id="btn-left" className="control-btn" onTouchStart={handleTouchStart('ArrowLeft')} onTouchEnd={handleTouchEnd('ArrowLeft')}>←</div>
                <div id="btn-right" className="control-btn" onTouchStart={handleTouchStart('ArrowRight')} onTouchEnd={handleTouchEnd('ArrowRight')}>→</div>
            </div>
            <div className="control-group">
                <div id="btn-action" className="control-btn jump-btn" onTouchStart={handleTouchStart('Space')} onTouchEnd={handleTouchEnd('Space')}>↑</div>
            </div>
        </div>

        {/* MODALS */}
        <div className={`modal ${activeModal === 'about' ? 'show' : ''}`} id="modal-about">
            <div className="modal-content">
                <h2 className="modal-header">PROFILE // TASFIA</h2>
                <div className="modal-body">
                   <About />
                </div>
                <div className="modal-footer">
                    <button className="btn-exit" onClick={closeModal}>EXIT TO WORLD</button>
                </div>
            </div>
        </div>
        
        <div className={`modal ${activeModal === 'education' ? 'show' : ''}`} id="modal-education">
            <div className="modal-content">
                <h2 className="modal-header">ARCHIVE // EDUCATION</h2>
                <div className="modal-body">
                   <Education />
                </div>
                <div className="modal-footer">
                    <button className="btn-exit" onClick={closeModal}>EXIT TO WORLD</button>
                </div>
            </div>
        </div>

        <div className={`modal ${activeModal === 'experience' ? 'show' : ''}`} id="modal-experience">
            <div className="modal-content">
                <h2 className="modal-header">LOG // WORK EXPERIENCE</h2>
                <div className="modal-body">
                   <Experience />
                </div>
                <div className="modal-footer">
                    <button className="btn-exit" onClick={closeModal}>EXIT TO WORLD</button>
                </div>
            </div>
        </div>

        <div className={`modal ${activeModal === 'projects' ? 'show' : ''}`} id="modal-projects">
            <div className="modal-content">
                <h2 className="modal-header">LAB // PROJECTS</h2>
                <div className="modal-body">
                   <Projects />
                </div>
                <div className="modal-footer">
                    <button className="btn-exit" onClick={closeModal}>EXIT TO WORLD</button>
                </div>
            </div>
        </div>

        <div className={`modal ${activeModal === 'publications' ? 'show' : ''}`} id="modal-publications">
            <div className="modal-content">
                <h2 className="modal-header">ARCHIVE // PUBLICATIONS</h2>
                <div className="modal-body">
                   <Publications />
                </div>
                <div className="modal-footer">
                    <button className="btn-exit" onClick={closeModal}>EXIT TO WORLD</button>
                </div>
            </div>
        </div>

        <div className={`modal ${activeModal === 'contact' ? 'show' : ''}`} id="modal-contact">
            <div className="modal-content">
                <h2 className="modal-header">COMMS // CONTACT</h2>
                <div className="modal-body">
                   <Contact />
                </div>
                <div className="modal-footer">
                    <button className="btn-exit" onClick={closeModal}>EXIT TO WORLD</button>
                </div>
            </div>
        </div>
    </>
  );
}
