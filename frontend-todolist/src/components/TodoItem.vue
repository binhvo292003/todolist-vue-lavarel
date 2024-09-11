<template>
    <label>
        <input type="checkbox" v-model="todo.completed" @change="updateTodo()" />
        <span class="bubble business"></span>
    </label>

    <div :class="`todo-content`">
        <input type=" text" v-model="todo.title" />
    </div>

    <div class="actions">
        <button class="delete" @click="removeTodo()">Delete</button>
        <button class="edit" @click="">Edit</button>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps(['todo']);
const emit = defineEmits(['todoChanged']);

const todo = ref(props.todo);

const updateTodo = async () => {
    try {
        const response = await (await axios.put(`http://127.0.0.1:8000/api/todos/${todo.value.id}`, todo.value))
            .then(response => {
                if (response.status === 200) {
                    emit('reloadList');
                }
            })
    } catch (error) {
        console.error('Error updating todo:', error);
    }
}

const removeTodo = async () => {
    try {
        const response = await axios.delete(`http://127.0.0.1:8000/api/todos/${todo.value.id}`)
            .then(response => {
                if (response.status == 200) {
                    console.log('Delete Success');
                    emit('reloadList');
                }
            })
    } catch (error) {
        console.error('Error deleting todo:', error);
    }
}
</script>