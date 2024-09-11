<template>
    <section class="create-todo">
        <h3>CREATE A TASK</h3>
        <form id="new-todo-form" @submit.prevent="addTodo">
            <input type="text" name="content" id="content" placeholder="e.g. make a video" v-model="input_content" />
            <input type="submit" value="Add todo" />
        </form>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const input_content = ref('');
const emit = defineEmits(['reloadList']);

const addTodo = async () => {
    if (input_content.value.trim() === '') {
        return;
    }

    const newTodo = {
        title: input_content.value,
        completed: false,
        editable: false,
        createdAt: new Date().getTime()
    }

    try {
        await axios.post('http://127.0.0.1:8000/api/todos', newTodo)
            .then(reponse => {
                if (reponse.status == 201) {
                    emit('reloadList');
                    input_content.value = "";
                }
            });
    } catch (error) {
        console.error('Error adding todo:', error);
    }
}
</script>

<style scoped>
#new-todo-form {
    display: flex;
    flex-direction: row;
    gap: 10px;
}
</style>