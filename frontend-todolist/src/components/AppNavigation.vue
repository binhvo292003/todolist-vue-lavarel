<template>
    <nav class="navbar">
        <ul class="navbar-list">
            <li class="navbar-item"><router-link to="/" class="navbar-link" active-class="active">Home</router-link>
            </li>
            <li class="navbar-item"><router-link to="/todo" class="navbar-link" active-class="active">Todo</router-link>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { ref, computed } from 'vue'
import Home from '@/pages/Home.vue';
import Todo from '@/pages/Todo.vue';

const routes = {
    '/': Home,
    '/todo': Todo,
}

const currentPath = ref(window.location.hash)

window.addEventListener('hashchange', () => {
    currentPath.value = window.location.hash
})

const currentView = computed(() => {
    return routes[currentPath.value.slice(1) || '/'] || NotFound
})
</script>

<style scoped>
.navbar {
    background-color: #333;
    padding: 14px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.navbar-list {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navbar-item {
    margin: 0 10px;
}

.navbar-link {
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    font-size: 17px;
}

.navbar-link:hover {
    background-color: #ddd;
    color: black;
}

.navbar-link.active {
    background-color: var(--business);
    color: white;
}
</style>