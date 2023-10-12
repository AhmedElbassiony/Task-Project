<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('products.edit', $id) }}" class="dropdown-item"><i class="icon-pencil7"></i> تعديل بيانات
                المنتج </a>

        </div>
    </div>
    <form action="{{ route('products.destroy', $id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn list-icons-item text-danger-600"
            style="padding: 0;background: transparent; color: red"
            onclick="return confirm('هل انت متاكد انك تريد حذف هذا المنتج ؟');">
            <i class="icon-trash"></i>
        </button>
    </form>
</div>
