<template>
    <label>
        <input type="checkbox" v-model="todo.completed" :true-value="1" :false-value="0" @change="updateTodo()" />
        <span class="bubble business"></span>
    </label>

    <div class="todo-content">
        <input type="text" v-model="todo.title" :class="[todo.completed ? 'done' : '']" />
    </div>

    <div class="actions">
        <button class="delete" @click="removeTodo()">Delete</button>
        <button class="edit" @click="">Edit</button>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, computed } from 'vue';

const props = defineProps(['todo']);
const emit = defineEmits(['todoChanged']);
const todo = ref(props.todo);

const updateTodo = async () => {
    try {
        const response = await axios.put(`http://127.0.0.1:8000/api/todos/${todo.value.id}`, todo.value);
        if (response.status === 200) {
            emit('todoChanged');
        }
    } catch (error) {
        console.error('Error updating todo:', error);
    }
}

const removeTodo = async () => {
    try {
        const response = await axios.delete(`http://127.0.0.1:8000/api/todos/${todo.value.id}`);
        if (response.status === 200) {
            emit('todoChanged');
        }
    } catch (error) {
        console.error('Error deleting todo:', error);
    }
}
</script>

<style scoped>
.done {
    text-decoration: line-through;
    color: gray;
}

.bubble {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid var(--business);
    box-shadow: var(--business-glow);
}

.bubble.completed {
    background-color: var(--business);
    box-shadow: var(--business-glow);
}

.bubble::after {
    content: "";
    display: block;
    opacity: 0;
    width: 0px;
    height: 0px;
    background-color: var(--business);
    box-shadow: var(--business-glow);
    border-radius: 50%;
    transition: 0.2s ease-in-out;
}

input:checked~.bubble::after {
    width: 10px;
    height: 10px;
    opacity: 1;
}
</style>