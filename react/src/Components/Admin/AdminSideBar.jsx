import { Link } from "react-router-dom"


const AdminSideBar = () => {
  return (
    <div className="sidebar">
      <div className="d-flex flex-column">
        <Link to="/admin/allorders" style={{ textDecoration: 'none' }}>
        <div className="admin-side-text mt-3 border-bottom p-2 mx-auto text-center">
          اداره الطلبات
        </div>
        </Link>
        <Link to="/admin/allproducts" style={{ textDecoration: 'none' }}>
          <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
            ادارة المنتجات
          </div>
        </Link>
        <Link to="/admin/addbrand" style={{ textDecoration: 'none' }}>
          <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
            اضف ماركة
          </div>
        </Link>
        <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
          اضف تصنيف
        </div>
        <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
          اضف تصنيف فرعى
        </div>
        <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
          اضف منتج
        </div>
      </div>
    </div>
  )
}

export default AdminSideBar