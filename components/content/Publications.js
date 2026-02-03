export default function Publications() {
  return (
    <>
      <div className="project-card">
          <h3>🧠 ML Framework for Adult ASD Detection</h3>
          <p><strong>Published:</strong> IEEE ICCIT 2024</p>
          <p>Co-authored study evaluating 8 classifiers with advanced feature scaling. Decision Tree achieved <strong>100% accuracy</strong> on adult ASD dataset.</p>
          <p><strong>Tech:</strong> Scikit-learn, Quantile Transformer, SHAP</p>
          <p><a href="https://ieeexplore.ieee.org/document/11021812" target="_blank">→ View Paper (IEEE)</a></p>
      </div>

      <div className="project-card">
          <h3>🧬 Advancements in Breast Cancer Detection: Systematic Review</h3>
          <p><strong>Published:</strong> <em>BioMedInformatics</em> (MDPI), 2025</p>
          <p>Review showing CNNs achieve <strong>100% accuracy in ultrasound</strong> and <strong>99.96% in mammography</strong>. Highlights thermal imaging as low-cost alternative.</p>
          <p><a href="https://doi.org/10.3390/biomedinformatics5030046" target="_blank">→ View Paper (MDPI)</a></p>
      </div>

      <div className="project-card">
          <h3>🌱 Green Behavior in Plastic Consumption</h3>
          <p><strong>Published:</strong> ICCCN-2025 (Springer)</p>
          <p>ML model (89% accuracy) on 500-user survey to identify eco-conscious consumers using SHAP for interpretability.</p>
          <p><strong>Tech:</strong> Logistic Regression, SHAP, XAI</p>
      </div>
    </>
  );
}
