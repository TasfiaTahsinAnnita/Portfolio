export default function Projects() {
  return (
    <>
      <div className="project-card">
          <h3>🚨 Real-Time Stampede Detection (BSc Thesis)</h3>
          <p>Built an AI system to prevent crowd disasters using a custom dataset of <strong>1,199 grayscale crowd images</strong>.</p>
          <ul>
              <li>CNN model: <strong>97% accuracy, 98% precision & recall</strong> — outperforms ResNet101/VGG16</li>
              <li>Explainability via <strong>SHAP + Grad-CAM</strong></li>
              <li>Extended to video using <strong>Farneback optical flow, SimpleBlobDetector, motion heuristics</strong></li>
              <li>Designed for integration with existing CCTV systems</li>
          </ul>
          <p><strong>Tech:</strong> Python, OpenCV, TensorFlow, SHAP, Scikit-image</p>
      </div>

      <div className="project-card">
          <h3>🍕 The EWU Slice – Food Delivery System</h3>
          <p>Full-stack web app (Domino’s-style) for CSE 412 Software Engineering course.</p>
          <ul>
              <li>Customer portal: menu browse, order customization, real-time delivery tracking</li>
              <li>Admin & Rider dashboards for order and delivery management</li>
              <li>Personalized user experience</li>
          </ul>
          <p><strong>Tech:</strong> HTML, CSS, JavaScript, [Backend: PHP/SQL]</p>
      </div>

      <div className="project-card">
          <h3>🤖 AskAnnBot – AI PDF Q&A Chatbot</h3>
          <p>Chatbot that answers questions from any PDF using RAG pipeline.</p>
          <ul>
              <li>Embeddings: <strong>Sentence-Transformers</strong></li>
              <li>Retrieval: <strong>FAISS vector DB</strong></li>
              <li>LLM: <strong>Google Gemini</strong></li>
              <li>Memory: multi-turn conversation support</li>
          </ul>
          <p><strong>Tech:</strong> Python, Streamlit, LangChain, FAISS, Google Gemini</p>
          <p><a href="https://github.com/TasfiaTahsinAnnita" target="_blank">→ GitHub Profile</a></p>
      </div>
    </>
  );
}
