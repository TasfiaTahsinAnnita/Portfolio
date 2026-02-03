# Portfolio (Next.js Version)

## 🚀 How to Deploy to Vercel

**IMPORTANT:** This repository contains the Next.js app in a subfolder named `portfolio-next`.

To deploy successfully, you MUST configure the **Root Directory** in Vercel:

1. Go to your Vercel Project Settings.
2. Find the **"Root Directory"** section.
3. Click "Edit".
4. Select `portfolio-next` (or type `portfolio-next`).
5. Save and Redeploy.

If you don't do this, Vercel will look at the old PHP files and fail with "No Next.js version detected".
