"use client";
import { useState } from 'react';

export default function Contact() {
  const [status, setStatus] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    setStatus('sending');
    const formData = new FormData(e.target);
    // TODO: Implement API
    // For now, mock success
    setTimeout(() => {
        setStatus('success');
    }, 1000);
  };

  return (
    <>
      <p>Let's connect or collaborate!</p>
      <div style={{margin: '1.2rem 0', lineHeight: 1.6}}>
          📧 <strong>Email:</strong> tasfiatahsinannita@gmail.com<br />
          📱 <strong>Phone:</strong> (+880) 1733522836<br />
          💼 <a href="https://linkedin.com/in/tasfiatahsinannita" target="_blank">LinkedIn</a> | 
          💻 <a href="https://github.com/TasfiaTahsinAnnita" target="_blank">GitHub</a>
      </div>

      <h3 style={{marginTop: '1.5rem'}}>Send a message:</h3>
      <form id="contact-form" className="contact-form" onSubmit={handleSubmit}>
          <input type="text" name="name" placeholder="Name" required />
          <input type="email" name="email" placeholder="Email" required />
          <textarea name="message" placeholder="Your message" rows="3" required></textarea>
          <button type="submit">TRANSMIT</button>
          <div id="form-response" className={status === 'success' ? 'success' : status === 'error' ? 'error' : ''}>
            {status === 'success' && 'Message transmitted.'}
            {status === 'sending' && 'Transmitting...'}
          </div>
      </form>
    </>
  );
}
