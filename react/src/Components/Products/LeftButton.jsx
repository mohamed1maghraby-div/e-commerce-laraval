import next from '../../Assets/images/next.png'

const LeftButton = (onClick, onDisable) => {
  return (
    <img
        src={next}
        alt=''
        width='35px'
        onClick={onClick}
        // eslint-disable-next-line react/no-unknown-property
        onDisable={onDisable}
        height='35px'
        style={{ float: 'left', marginTop: '220px', cursor: 'pointer' }}
    />
  )
}

export default LeftButton