<template>
    <section class="todo-list">
        <h3>TODO LIST</h3>
        <div class="actions">
            <button class="done-items" @click="toggleShowAll">{{ show_all_text }}</button>
            <button class="done-items" @click="clearStorage">Clear</button>
        </div>
        <div class="list" id="todo-list">
            <div v-for="todo in filteredTodos" :key="todo.id" :class="`todo-item`">
                <TodoItem :todo="todo" v-on:todoChanged="$emit('reloadList')" />
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

import TodoItem from './TodoItem.vue';

// props and data
const props = defineProps(['todos']);
const emit = defineEmits(['reloadList']);

const show_all = ref(true);

const filteredTodos = computed(() => {
    return show_all.value ? props.todos : props.todos.filter(todo => !todo.completed);
});

const show_all_text = computed(() => {
    return show_all.value ? 'Show Task Not Complete' : 'Show All Task';
});

const toggleShowAll = () => {
    show_all.value = !show_all.value;
}

const clearStorage = async () => {
    await axios.delete('http://127.0.0.1:8000/api/todos')
        .then(response => {
            if (response.status == 200) {
                console.log('Clear Todo List Success');
                emit('reloadList');
            }
        })

}
</script>

<style scoped></style>