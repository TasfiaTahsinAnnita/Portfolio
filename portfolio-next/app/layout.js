import "./globals.css";

export const metadata = {
  title: "Tasfia Tahsin Annita's Portfolio",
  description: "Portfolio of Tasfia Tahsin Annita - AI, Machine Learning, Full Stack",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body>
        {children}
      </body>
    </html>
  );
}
