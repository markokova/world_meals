<form action="/" method="POST">
    @csrf
    <label for="category">Category: </label>
    <select name="category" id="category">
        <option value="185">185</option>
        <option value="186">186</option>
        <option value="187">187</option>
    </select>
    <button
        type="submit"
        class="h-10 w-20 text-white rounded-lg bg-blue-500 hover:bg-blue-600">
        Search
    </button>
    </form>