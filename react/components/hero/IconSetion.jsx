import { Box, Container, Divider, Stack, Typography, useMediaQuery, useTheme } from "@mui/material";
import {
    AccessAlarmOutlined,
    CreditScoreOutlined,
    ElectricBolt,
    WorkspacePremiumOutlined,
} from "@mui/icons-material";

const IconSetion = () => {
    const theme = useTheme();
    return (
        <Container sx={{ mt: 3, bgcolor: theme.palette.mode === "dark" ? "#000" : "#fff" }}>
            <Stack 
            divider={useMediaQuery('(min-width:600px)') ? <Divider orientation="vertical" flexItem /> : null}
            sx={{ flexWrap: "wrap" }}
            direction={"row"}
            alignItems={"center"}
            >
                <MyBox
                    icon={<ElectricBolt />}
                    title={"Fast Delivery"}
                    subTitle={"Start from $10"}
                />
                <MyBox
                    icon={<WorkspacePremiumOutlined />}
                    title={"Mony Guarantee"}
                    subTitle={"7 Days Back"}
                />
                <MyBox
                    icon={<AccessAlarmOutlined />}
                    title={"365 Days"}
                    subTitle={"For free return"}
                />
                <MyBox
                    icon={<CreditScoreOutlined />}
                    title={"Payment"}
                    subTitle={"Secure system"}
                />
            </Stack>
        </Container>
    );
};
export default IconSetion;

// eslint-disable-next-line react/prop-types
const MyBox = ({ icon, title, subTitle }) => {
    const theme = useTheme();
    return (
        <Box
        
            sx={{
                width: 250,
                display: "flex",
                flexGrow: 1,
                alignItems: "center",
                gap: 3,
                justifyContent: useMediaQuery('(min-width:600px)') ? "center" : "left",
                py: 1.6,
            }}
        >
            {icon}
            <Box>
                <Typography variant="body1">{title}</Typography>
                <Typography
                    sx={{
                        fontWeight: 300,
                        color: theme.palette.text.secondary,
                    }}
                    variant="body1"
                >
                    {subTitle}
                </Typography>
            </Box>
        </Box>
    );
};
