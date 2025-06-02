(() => {
    "use strict";

    const getStoredTheme = () => localStorage.getItem("theme");
    const setStoredTheme = (theme) => localStorage.setItem("theme", theme);

    const getPreferredTheme = () => {
        const storedTheme = getStoredTheme();
        if (storedTheme) {
            return storedTheme;
        }

        return window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
    };

    const setTheme = (theme) => {
        if (theme === "auto") {
            document.documentElement.setAttribute(
                "data-bs-theme",
                window.matchMedia("(prefers-color-scheme: dark)").matches
                    ? "dark"
                    : "light"
            );
        } else {
            document.documentElement.setAttribute("data-bs-theme", theme);
        }
    };

    const showActiveTheme = (theme) => {
        document
            .querySelectorAll("[data-bs-theme-value]")
            .forEach((element) => {
                element.classList.remove("text-primary");
                element.setAttribute("aria-pressed", "false");
            });

        const activeButton = document.querySelector(
            `[data-bs-theme-value="${theme}"]`
        );
        if (activeButton) {
            activeButton.classList.add("text-primary");
            activeButton.setAttribute("aria-pressed", "true");
        }
    };

    setTheme(getPreferredTheme());
    showActiveTheme(getPreferredTheme());

    window.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll("[data-bs-theme-value]").forEach((button) => {
            button.addEventListener("click", () => {
                const theme = button.getAttribute("data-bs-theme-value");
                setStoredTheme(theme);
                setTheme(theme);
                showActiveTheme(theme);
            });
        });
    });
})();
