// ========================================
// ULTRA-MODERN LEXORA WORKSPACE - JAVASCRIPT
// ========================================

// Wait for DOM to be ready
document.addEventListener("DOMContentLoaded", () => {
    initMobileMenu()
    initSearchFunctionality()
    initKeyboardShortcuts()
    initButtonInteractions()
    initCardAnimations()
    initSmoothScrolling()
})

// ========================================
// MOBILE MENU
// ========================================
function initMobileMenu() {
    const mobileToggle = document.getElementById("mobileMenuToggle")
    const sidebar = document.getElementById("sidebar")
    const closeSidebar = document.getElementById("closeSidebar")
    const backdrop = document.getElementById("sidebarBackdrop")

    if (!mobileToggle || !sidebar) return

    mobileToggle.addEventListener("click", () => {
        sidebar.classList.add("active")
        document.body.style.overflow = "hidden"
    })

    closeSidebar?.addEventListener("click", () => {
        sidebar.classList.remove("active")
        document.body.style.overflow = ""
    })

    backdrop?.addEventListener("click", () => {
        sidebar.classList.remove("active")
        document.body.style.overflow = ""
    })

    // Close sidebar on window resize if open
    window.addEventListener("resize", () => {
        if (window.innerWidth > 1024) {
            sidebar.classList.remove("active")
            document.body.style.overflow = ""
        }
    })
}

// ========================================
// SEARCH FUNCTIONALITY
// ========================================
function initSearchFunctionality() {
    const searchInput = document.getElementById("searchInput")
    const toolCards = document.querySelectorAll(".tool-card")
    const featuredCard = document.querySelector(".featured-card")

    if (!searchInput) return

    searchInput.addEventListener("input", (e) => {
        const searchTerm = e.target.value.toLowerCase().trim()

        // Filter tool cards
        toolCards.forEach((card) => {
            const title = card.querySelector(".tool-title")?.textContent.toLowerCase() || ""
            const description = card.querySelector(".tool-description")?.textContent.toLowerCase() || ""
            const tags = Array.from(card.querySelectorAll(".tag"))
                .map((tag) => tag.textContent.toLowerCase())
                .join(" ")

            if (title.includes(searchTerm) || description.includes(searchTerm) || tags.includes(searchTerm)) {
                card.style.display = "flex"
                card.style.opacity = "0"
                card.style.animation = "fadeInUp 0.4s ease forwards"
            } else {
                card.style.display = "none"
            }
        })

        // Filter featured card
        if (featuredCard) {
            const featuredTitle = featuredCard.querySelector(".featured-title")?.textContent.toLowerCase() || ""
            const featuredDesc = featuredCard.querySelector(".featured-description")?.textContent.toLowerCase() || ""

            if (featuredTitle.includes(searchTerm) || featuredDesc.includes(searchTerm)) {
                featuredCard.style.display = "block"
                featuredCard.style.opacity = "0"
                featuredCard.style.animation = "fadeInUp 0.4s ease forwards"
            } else {
                featuredCard.style.display = "none"
            }
        }

        // Show all if search is empty
        if (searchTerm === "") {
            toolCards.forEach((card) => {
                card.style.display = "flex"
                card.style.opacity = "1"
                card.style.animation = "none"
            })
            if (featuredCard) {
                featuredCard.style.display = "block"
                featuredCard.style.opacity = "1"
                featuredCard.style.animation = "none"
            }
        }
    })
}

// ========================================
// KEYBOARD SHORTCUTS
// ========================================
function initKeyboardShortcuts() {
    const searchInput = document.getElementById("searchInput")

    document.addEventListener("keydown", (e) => {
        // "/" key to focus search
        if (e.key === "/" && document.activeElement !== searchInput) {
            e.preventDefault()
            searchInput?.focus()
        }

        // Escape key to clear search and blur
        if (e.key === "Escape") {
            if (document.activeElement === searchInput) {
                searchInput.value = ""
                searchInput.dispatchEvent(new Event("input"))
                searchInput.blur()
            }

            // Also close mobile menu if open
            const sidebar = document.getElementById("sidebar")
            if (sidebar?.classList.contains("active")) {
                sidebar.classList.remove("active")
                document.body.style.overflow = ""
            }
        }
    })
}

// ========================================
// BUTTON INTERACTIONS
// ========================================
function initButtonInteractions() {
    const buttons = document.querySelectorAll(".header-btn, .action-btn, .launch-btn, .nav-item")

    buttons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            // Haptic feedback simulation
            if (window.navigator && window.navigator.vibrate) {
                window.navigator.vibrate(10)
            }

            // Ripple effect
            const ripple = document.createElement("span")
            const rect = this.getBoundingClientRect()
            const size = Math.max(rect.width, rect.height)
            const x = e.clientX - rect.left - size / 2
            const y = e.clientY - rect.top - size / 2

            ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        left: ${x}px;
        top: ${y}px;
        pointer-events: none;
      `

            this.style.position = "relative"
            this.style.overflow = "hidden"
            this.appendChild(ripple)

            setTimeout(() => ripple.remove(), 600)
        })
    })
}

// ========================================
// CARD ANIMATIONS
// ========================================
function initCardAnimations() {
    const cards = document.querySelectorAll(".tool-card, .featured-card")

    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = "1"
                    entry.target.style.transform = "translateY(0)"
                }, index * 100)
                observer.unobserve(entry.target)
            }
        })
    }, observerOptions)

    cards.forEach((card) => {
        card.style.opacity = "0"
        card.style.transform = "translateY(30px)"
        card.style.transition = "opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)"
        observer.observe(card)
    })
}

// ========================================
// SMOOTH SCROLLING
// ========================================
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const target = document.querySelector(this.getAttribute("href"))
            if (target) {
                e.preventDefault()
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                })
            }
        })
    })
}

// ========================================
// DYNAMIC ANIMATIONS
// ========================================
const styleSheet = document.createElement("style")
styleSheet.textContent = `
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes ripple {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }

  @keyframes shimmer {
    0% {
      background-position: -1000px 0;
    }
    100% {
      background-position: 1000px 0;
    }
  }
`
document.head.appendChild(styleSheet)

// ========================================
// PERFORMANCE OPTIMIZATION
// ========================================
function debounce(func, wait) {
    let timeout
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout)
            func(...args)
        }
        clearTimeout(timeout)
        timeout = setTimeout(later, wait)
    }
}

// Handle window resize with debounce
window.addEventListener(
    "resize",
    debounce(() => {
        // Recalculate layouts if needed
        const sidebar = document.getElementById("sidebar")
        if (window.innerWidth > 1024 && sidebar?.classList.contains("active")) {
            sidebar.classList.remove("active")
            document.body.style.overflow = ""
        }
    }, 250),
)

// ========================================
// CONSOLE SIGNATURE
// ========================================
console.log(
    "%c🚀 Lexora Workspace Ultra",
    "font-size: 24px; font-weight: 900; background: linear-gradient(135deg, #6366f1, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; padding: 10px;",
)
console.log("%cModern. Professional. Powerful.", "font-size: 14px; color: #a1a1aa; font-weight: 500;")
console.log("%cBuilt with cutting-edge web technologies", "font-size: 12px; color: #71717a;")