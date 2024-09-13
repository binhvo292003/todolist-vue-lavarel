<template>
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2023 Your Company. All rights reserved.</p>
            <nav class="footer-nav">
                <a href="/privacy-policy" class="footer-link">Privacy Policy</a>
                <a href="/terms-of-service" class="footer-link">Terms of Service</a>
                <a href="/contact" class="footer-link">Contact</a>
            </nav>
        </div>
    </footer>
</template>

<style scoped>
.footer {
    background-color: #333;
    padding: 14px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    bottom: 0;
}


.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.footer-nav {
    margin-top: 10px;
}

.footer-link {
    color: white;
    margin: 0 10px;
    text-decoration: none;
}

.footer-link:hover {
    text-decoration: underline;
}
</style>