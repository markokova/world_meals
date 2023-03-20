<form action="/" method="POST">
    @csrf
        <label for="per_page">Meals per page:</label>
        <select name="per_page" id="per_page">
            <option value="8">8</option>
            <option value="12">12</option>
            <option value="20">20</option>
        </select>
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-blue-500 hover:bg-blue-600"
            >
                OK
            </button>
    </form>