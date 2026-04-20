import "./globals.css";
import { Analytics } from '@vercel/analytics/next';

export const metadata = {
  title: "Tasfia Tahsin Annita's Portfolio",
  description: "Portfolio of Tasfia Tahsin Annita - AI, Machine Learning, Full Stack",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body>
        {children}
        <Analytics />
      </body>
    </html>
  );
}
