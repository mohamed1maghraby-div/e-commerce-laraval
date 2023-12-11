
// eslint-disable-next-line react/prop-types
const SubTitle = ({title, btntitle}) => {
  return (
    <div className='d-flex justify-content-between pt-4'>
        <div className='sub-title'>{title}</div>
        {btntitle ? (
            <div className='shopping-now'>{btntitle}</div>
        ) : null}    
    </div>
  )
}

export default SubTitle