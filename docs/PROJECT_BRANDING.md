# Design & Branding — StockWise Pro

## Brand Identity

**Name**: StockWise Pro
**Tagline**: Smart. Colorful. Efficient.
**Primary Theme**: Blue-to-teal gradient with glass morphism UI

---

## Color Palette

### Primary Gradients

| Name | Colors | Used For |
|------|--------|----------|
| Ocean | `#1e40af` → `#0f766e` → `#059669` | Sidebar, page background |
| Purple | `#667eea` → `#764ba2` | Table headers, buttons |
| Cyan | `#4facfe` → `#00f2fe` | Success actions |
| Pink-Red | `#f093fb` → `#f5576c` | Warning / edit actions |
| Pink-Yellow | `#fa709a` → `#fee140` | Danger / delete actions |
| Green-Teal | `#43e97b` → `#38f9d7` | Positive indicators |

### Status Colors

| Status | Background | Text |
|--------|-----------|------|
| In Stock | `#d4edda` | `#155724` |
| Low Stock | `#fff3cd` | `#856404` |
| Out of Stock | `#f8d7da` | `#721c24` |
| Active | `#d4edda` | `#155724` |
| Inactive | `#f8d7da` | `#721c24` |

---

## Typography

- **Primary font**: Times New Roman, Times, serif
- **Fallback**: serif
- **Headings**: Bold, gradient text using `-webkit-background-clip: text`
- **Body**: Regular weight, `#333` or `#495057`
- **Labels**: 600 weight, uppercase with letter-spacing for table headers

---

## UI Components

### Cards
- White background with `rgba(255,255,255,0.95)`
- `backdrop-filter: blur(20px)` glass effect
- `border-radius: 20px`
- Subtle box shadow: `0 20px 40px rgba(0,0,0,0.1)`
- Hover: `translateY(-5px)` lift effect

### Buttons
- `border-radius: 12px`
- Gradient backgrounds
- Hover: `translateY(-3px)` lift
- Shine sweep animation on hover

### Sidebar
- Glass morphism: `rgba(255,255,255,0.1)` + `backdrop-filter: blur(20px)`
- Active item: left border highlight + slightly brighter background
- Hover: `translateX(5px)` slide effect

### Tables
- Gradient header row
- Alternating hover highlight
- Status badges with rounded pill shape

### Alerts
- Left border accent (4–5px)
- Soft background matching the alert type color
- Icon + message layout

---

## Layout

- **Sidebar width**: 260px (fixed)
- **Main content**: `flex: 1` (fills remaining space)
- **Page padding**: 30px
- **Grid gaps**: 15–25px
- **Breakpoint**: 768px (stacks to single column on mobile)

---

## Responsive Design

All pages use CSS Grid with `repeat(auto-fit, minmax(..., 1fr))` for stat cards and form rows, ensuring they reflow naturally on smaller screens. The sidebar collapses on mobile.

---

## Icons

Font Awesome 6 Free is used throughout:
- Navigation: `fa-tachometer-alt`, `fa-box`, `fa-tags`, `fa-truck`, etc.
- Actions: `fa-plus`, `fa-edit`, `fa-trash`, `fa-download`
- Status: `fa-check-circle`, `fa-exclamation-triangle`, `fa-times-circle`

---

**© 2026 StockWise Pro**
