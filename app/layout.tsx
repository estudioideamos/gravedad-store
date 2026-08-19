import type { Metadata } from "next";
import "./globals.css";
import "./logos.css";

export const metadata: Metadata = {
  title: "Gravedad Store | TCG, cartas y juegos de mesa",
  description: "Cartas sueltas, productos sellados, juegos de mesa, accesorios, preventas y eventos.",
  other: {
    "codex-preview": "development",
  },
  icons: {
    icon: "/favicon.svg",
    shortcut: "/favicon.svg",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="es">
      <body className="antialiased">{children}</body>
    </html>
  );
}
