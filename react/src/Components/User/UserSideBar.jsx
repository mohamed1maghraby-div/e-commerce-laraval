import { Link } from "react-router-dom"


const UserSideBar = () => {
  return (
    <div className="sidebar">
      <div className="d-flex flex-column">
        <Link to="/user/allorders" style={{ textDecoration: 'none' }}>
        <div className="admin-side-text mt-3 border-bottom p-2 mx-auto text-center">
          اداره الطلبات
        </div>
        </Link>
        <Link to="/admin/allproducts" style={{ textDecoration: 'none' }}>
          <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
            المنتجات المفضلة
          </div>
        </Link>
        <Link to="/admin/addbrand" style={{ textDecoration: 'none' }}>
          <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
            العناوين الشخصية
          </div>
        </Link>
        <Link to="/admin/addcategory" style={{ textDecoration: 'none' }}>
          <div className="admin-side-text mt-1 border-bottom p-2 mx-auto text-center">
            الملف الشخصى
          </div>
        </Link>
      </div>
    </div>
  )
}

export default UserSideBar