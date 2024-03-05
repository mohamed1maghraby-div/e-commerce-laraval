import { Row } from "react-bootstrap"
import SidebarSearchHook from "../../hook/search/sidebar-search-hook"

const SideFilter = () => {

    const [category,brand,clickCategoy,clickBrand,priceFrom, priceTo] = SidebarSearchHook();
    
  return (
    <div className="mt-3">
        <Row>
            <div className="d-flex flex-column mt-2">
                <div className="filter-title">الفئة</div>
                <div className="d-flex mt-3">
                    <input onChange={clickCategoy} type="checkbox" value="0" />
                    <div className="filter-sub me-2">الكل</div>
                </div>
                {
                    category ? (category.map((item,index)=>{
                        return (
                            <div className="d-flex mt-3" key={index}>
                                <input onChange={clickCategoy} type="checkbox" value={item.id} />
                                <div className="filter-sub me-2">{ item.name }</div>
                            </div>
                        )
                    })) : <h6>لا يوجد تصنيفات</h6>
                }
            </div>

            <div className="d-flex flex-column mt-2">
                <div className="filter-title mt-3">الماركة</div>
                <div className="d-flex mt-3">
                    <input onChange={clickBrand} type="checkbox" value='0' />
                    <div className="filter-sub me-2">الكل</div>
                </div>
                {
                    brand ? (brand.map((item,index)=>{
                        return (
                            <div className="d-flex mt-3" key={index}>
                                <input onChange={clickBrand} type="checkbox" value={item.id} />
                                <div className="filter-sub me-2">{item.name}</div>
                            </div>
                        )
                    })) : <h6>لا يوجد برندات</h6>
                }
            </div>

            <div className="filter-title my-3">السعر</div>
            <div className="d-flex">
                <p className="filter-sub my-2">من:</p>
                <input
                    onChange={priceFrom}
                    className="m-2 text-center"
                    type="number"
                    style={{ width: '50px', height: '25px' }}
                    value={localStorage.getItem("priceFrom")}
                />
            </div>
            <div className="d-flex">
                <p className="filter-sub my-2">الى:</p>
                <input 
                    onChange={priceTo}
                    className="m-2 text-center"
                    type="number"
                    style={{ width: '50px', height: '25px' }}
                    value={localStorage.getItem("priceTo")}
                />
            </div>
        </Row>
    </div>
  )
}

export default SideFilter